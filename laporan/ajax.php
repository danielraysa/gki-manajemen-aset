<?php
    session_start();
    setlocale (LC_TIME, 'INDONESIAN');
    date_default_timezone_set("Asia/Jakarta");
    include "../connection.php";

    if(isset($_POST['filter'])) {
        $filter = $_POST['filter'];
        $tgl = $_POST['tgl_awal'];
        $tgl2 = $_POST['tgl_akhir'];
        $date = str_replace('/', '-', $tgl);
        $date2 = str_replace('/', '-', $tgl2);
        //echo $date."\n";
        $tgl_awal = date("Y-m-d", strtotime($date));
        $tgl_akhir = date("Y-m-d", strtotime($date2));
        //echo $tgl_pemeliharaan."\n";
        //echo "UPDATE pemeliharaan_aset SET TANGGAL_PEMELIHARAAN = '".$tgl_pemeliharaan."', BIAYA_PEMELIHARAAN = '".$biaya."', HASIL_PEMELIHARAAN = '".$keterangan."' WHERE ID_PEMELIHARAAN = '".$id_maintenance."'";
        //$query = mysqli_query($koneksi, "SELECT * FROM daftar_aset WHERE TANGGAL_PEMBELIAN BETWEEN ('".$tgl_awal."','".$tgl_akhir."')");
        $a = 1;
        $myObj = array();
        if($filter == "pengadaan") {
            $query = mysqli_query($koneksi,"SELECT p.id_pengadaan, d.id_aset, d.nama_aset, u.nama_lengkap, p.keterangan_usulan, p.tanggal_usulan, p.hasil_approval, d.harga_pembelian, d.tanggal_pembelian FROM pengadaan_aset p JOIN detil_usulan_pengadaan dp ON p.id_pengadaan = dp.id_pengadaan JOIN user u ON p.id_user = u.id_user JOIN daftar_aset d ON d.id_usulan_tambah = dp.id_usulan_tambah WHERE p.hasil_approval = 'Diterima' AND (d.tanggal_pembelian BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')");
            while($row = mysqli_fetch_array($query)){
                $aset = $row['nama_aset'];
                $nama = $row['nama_lengkap'];
                $tgl = tglIndo($row['tanggal_pembelian']);
                $harga = asRupiah($row['harga_pembelian']);
                $keterangan = $row['keterangan_usulan'];
                $array = array($a, $aset, $nama, $tgl, $harga, $keterangan);
                array_push($myObj, $array);
                $a++;
            }
        }
        if($filter == "peminjaman") {
            $query = mysqli_query($koneksi,"SELECT d.nama_aset, u.nama_lengkap, p.no_hp, p.keterangan_pinjam, p.tanggal_peminjaman, p.tanggal_pengembalian, p.realisasi_pengembalian, p.hasil_pengajuan FROM peminjaman_aset p JOIN user u ON p.id_user = u.id_user JOIN detail_peminjaman dp ON p.id_peminjaman = dp.id_peminjaman JOIN daftar_aset d ON dp.id_aset = d.id_aset WHERE p.hasil_pengajuan = 'Diterima' AND (p.tanggal_peminjaman BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') ORDER BY p.tanggal_peminjaman");

            while($row = mysqli_fetch_array($query)){
                $aset = $row['nama_aset'];
                $nama = $row['nama_lengkap'];
                $tgl = tglIndo($row['tanggal_peminjaman']);
                $harga = tglIndo($row['tanggal_pengembalian']);
                $keterangan = $row['keterangan_pinjam'];
                $array = array($a, $aset, $nama, $tgl, $harga, $keterangan);
                array_push($myObj, $array);
                $a++;
            }
        }
        if($filter == "pemeliharaan") {
            $query = mysqli_query($koneksi,"SELECT p.ID_PEMELIHARAAN, d.NAMA_ASET, d.KODE_ASET, p.BIAYA_PEMELIHARAAN, p.HASIL_PEMELIHARAAN, p.TANGGAL_PENJADWALAN, p.TANGGAL_PEMELIHARAAN, p.SELESAI_PEMELIHARAAN FROM pemeliharaan_aset p JOIN daftar_aset d ON p.ID_ASET = d.ID_ASET WHERE p.STATUS_PEMELIHARAAN = 'Selesai' AND (p.TANGGAL_PENJADWALAN BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')");
            while($row = mysqli_fetch_array($query)){
                $aset = $row['NAMA_ASET'];
                $hasil = $row['HASIL_PEMELIHARAAN'];
                $tgl = tglIndo($row['TANGGAL_PENJADWALAN']);
                $tgl1 = tglIndo($row['TANGGAL_PEMELIHARAAN']);
                $tgl2 = tglIndo($row['SELESAI_PEMELIHARAAN']);
                $biaya = asRupiah($row['BIAYA_PEMELIHARAAN']);
                $array = array($a, $aset, $hasil, $biaya, $tgl, $tgl1);
                array_push($myObj, $array);
                $a++;
            }
        }
        if($filter == "penghapusan") {
            $query = mysqli_query($koneksi,"SELECT p.id_penghapusan, d.kode_aset, d.nama_aset, u.nama_lengkap, p.keterangan_penghapusan, p.tanggal_usulan, p.hasil_approval FROM penghapusan_aset p JOIN detil_usulan_penghapusan dp ON p.id_penghapusan = dp.id_penghapusan JOIN user u ON p.id_user = u.id_user JOIN daftar_aset d ON d.id_aset = dp.id_aset WHERE p.hasil_approval = 'Diterima' AND (p.tanggal_usulan BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')");
            while($row = mysqli_fetch_array($query)){
                $aset = $row['nama_aset'];
                $nama = $row['nama_lengkap'];
                $tgl = tglIndo($row['tanggal_usulan']);
                $keterangan = $row['keterangan_penghapusan'];
                $array = array($a, $aset, $nama, $tgl, $keterangan);
                array_push($myObj, $array);
                $a++;
            }
        }
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

?>