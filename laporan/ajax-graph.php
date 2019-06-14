<?php
    session_start();
    setlocale (LC_TIME, 'INDONESIAN');
    date_default_timezone_set("Asia/Jakarta");
    include "../connection.php";

    if(isset($_POST['filter'])) {
        $filter = $_POST['filter'];
        $tgl = $_POST['tgl_awal'];
        $tgl2 = $_POST['tgl_akhir'];
        $jenis = $_POST['jenis_laporan'];
        $date = str_replace('/', '-', $tgl);
        $date2 = str_replace('/', '-', $tgl2);
        
        $tgl_awal = date("Y-m-d", strtotime($date));
        $tgl_akhir = date("Y-m-d", strtotime($date2));
        
        $a = 1;
        $myObj = array();
        if($filter == "pengadaan") {
            $query = mysqli_query($koneksi,"SELECT d.nama_aset, COUNT(d.nama_aset) as jumlah, SUM(d.harga_pembelian) as total FROM pengadaan_aset p JOIN detil_usulan_pengadaan dp ON p.id_pengadaan = dp.id_pengadaan JOIN user u ON p.id_user = u.id_user JOIN daftar_aset d ON d.id_usulan_tambah = dp.id_usulan_tambah WHERE p.hasil_approval = 'Diterima' AND (d.tanggal_pembelian BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') GROUP BY d.nama_aset");

            while($row = mysqli_fetch_array($query)){
                $aset = $row['nama_aset'];
                $jml = $row['jumlah'];
                $array = array('aset' => $aset, 'jumlah' => $jml);
                //$inc = array('aset' => $aset, 'jumlah' => $jml);
                array_push($myObj, $array);
                $a++;
            }
        }
        if($filter == "peminjaman") {
            $query = mysqli_query($koneksi,"SELECT d.nama_aset, COUNT(*) as jumlah FROM peminjaman_aset p JOIN detail_peminjaman dp ON p.id_peminjaman = dp.id_peminjaman JOIN daftar_aset d ON dp.id_aset = d.id_aset WHERE p.hasil_pengajuan = 'Diterima' AND (p.tanggal_peminjaman BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') GROUP BY d.nama_aset");
            while($row = mysqli_fetch_array($query)){
                $aset = $row['nama_aset'];
                $jml = $row['jumlah'];
                //$array = array($a, $aset, $jml, $biaya);
                $array = array('aset' => $aset, 'jumlah' => $jml);
                array_push($myObj, $array);
                $a++;
            }
        }
        if($filter == "pemeliharaan") {
            $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.NAMA_ASET, SUM(CASE WHEN p.STATUS_PEMELIHARAAN = 'SELESAI' THEN +1 ELSE 0 END) as JML_PEMELIHARAAN, SUM(CASE WHEN p.BIAYA_PEMELIHARAAN IS NULL THEN 0 ELSE p.BIAYA_PEMELIHARAAN END) AS BIAYA_PEMELIHARAAN FROM daftar_aset d JOIN pemeliharaan_aset p ON d.ID_ASET = p.ID_ASET WHERE d.STATUS_ASET = 'Aktif' AND (p.TANGGAL_PENJADWALAN BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') GROUP BY p.ID_ASET");
            while($row = mysqli_fetch_array($query)){
                $aset = $row['NAMA_ASET'];
                $jml = $row['JML_PEMELIHARAAN'];
                $biaya = $row['BIAYA_PEMELIHARAAN'];
                //$array = array($a, $aset, $jml, $biaya);
                $array = array('aset' => $aset, 'jumlah' => $jml);
                array_push($myObj, $array);
                $a++;
            }
        }
        if($filter == "penghapusan") {
            $query = mysqli_query($koneksi,"SELECT d.NAMA_ASET, COUNT(*) AS JUMLAH FROM penghapusan_aset p JOIN detil_usulan_penghapusan dp ON p.ID_PENGHAPUSAN = dp.ID_PENGHAPUSAN JOIN daftar_aset d ON d.ID_ASET = dp.ID_ASET WHERE p.HASIL_APPROVAL = 'Diterima' AND (p.TANGGAL_USULAN BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') GROUP BY d.NAMA_ASET");

            while($row = mysqli_fetch_array($query)){
                $aset = $row['NAMA_ASET'];
                $jml = $row['JUMLAH'];
                //$inc = array('aset' => $aset, 'jumlah' => $jml);
                $array = array('aset' => $aset, 'jumlah' => $jml);
                array_push($myObj, $array);
                $a++;
            }
        }
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

?>