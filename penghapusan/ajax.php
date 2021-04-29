<?php
    session_start();
    include "../connection.php";
    
    // kosongin item
    if(isset($_POST['empty'])){
        unset($_SESSION['temp_hapus']);
        //header("location:../penghapusan");
    }
    
    if(isset($_POST['hapus-item'])) {
        $val = $_POST['hapus-item'];
        
        $key_index = array_search($val, array_column($_SESSION['temp_hapus'], 'nama'));
        array_splice($_SESSION['temp_hapus'], $key_index, 1);
        
    }

    if(isset($_POST['usulan-hapus'])) {
        $id = $_POST['usulan-hapus'];
        // $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.NAMA_ASET, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, SUM(CASE WHEN p.STATUS_PEMELIHARAAN = 'SELESAI' THEN +1 ELSE 0 END) as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM daftar_aset d LEFT OUTER JOIN pemeliharaan_aset p ON d.ID_ASET = p.ID_ASET WHERE d.ID_ASET = '".$id."'");
        $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.NAMA_BARANG, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, SUM(CASE WHEN p.STATUS_PEMELIHARAAN = 'SELESAI' THEN +1 ELSE 0 END) as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM daftar_baru d LEFT OUTER JOIN pemeliharaan_aset p ON d.ID_ASET = p.ID_ASET WHERE d.ID_ASET = '".$id."'");
        
        $row = mysqli_fetch_array($query);
        $id_aset = $row['ID_ASET'];
        $nama_aset = $row['NAMA_BARANG'];
        $umur = $row['DIFF'];
        $jml_pemeliharaan = $row['JML_PEMELIHARAAN'];
        $bagi = ($row['HARGA_PEMBELIAN']-$row['NILAI_RESIDU'])/$row['MASA_MANFAAT'];
        $nilai = $row['HARGA_PEMBELIAN']-($bagi*($row['MASA_MANFAAT']-$row['DIFF']));
        $random_id = rand();
        $rand_bool = false;
        while($rand_bool = false) {
            if (in_array($random_id, $_SESSION['temp_hapus'])) {
                $random_id = rand();
            }
            else {
                $rand_bool = true;
            }
        }
        $add = array('temp_id' => $random_id, 'id_aset' => $id_aset, 'nama' => $nama_aset, 'umur' => $umur, 'jumlah_pemeliharaan' => $jml_pemeliharaan, 'nilai' => $nilai);
        array_push($_SESSION['temp_hapus'], $add);
        
    }

    // approve penghapusan
    if (isset($_GET['approve'])) {
        $id = $_GET['approve'];
        $date = date('Y-m-d H:i:s');
        $query = mysqli_query($koneksi, "UPDATE penghapusan_aset SET HASIL_APPROVAL = 'Diterima', TANGGAL_APPROVAL = '".$date."' WHERE ID_PENGHAPUSAN = '".$id."'");
        $insert = mysqli_query($koneksi, "INSERT INTO notifikasi(TABEL_REF, ID_REF, TGL_NOTIF, READ_NOTIF) VALUES ('penghapusan_aset', '".$id."', '".$date."', 0)");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
    }

    if (isset($_GET['reject'])) {
        $id = $_GET['reject'];
        $date = date('Y-m-d H:i:s');
        $query = mysqli_query($koneksi, "UPDATE penghapusan_aset SET HASIL_APPROVAL = 'Ditolak', TANGGAL_APPROVAL = '".$date."' WHERE ID_PENGHAPUSAN = '".$id."'");
        $insert = mysqli_query($koneksi, "INSERT INTO notifikasi(TABEL_REF, ID_REF, TGL_NOTIF, READ_NOTIF) VALUES ('penghapusan_aset', '".$id."', '".$date."', 0)");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }    
    }
    if (isset($_POST['delete-usulan'])) {
        $id = $_POST['delete-usulan'];
        $query = mysqli_query($koneksi, "UPDATE penghapusan_aset SET STATUS_USULAN = 'Dihapus' WHERE ID_penghapusan = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
    }

    if (isset($_POST['usulan_detail'])) {
        $id = $_POST['usulan_detail'];
        $myObj = array();
        $a = 1;
        //$query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.NAMA_ASET, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, SUM(CASE WHEN p.STATUS_PEMELIHARAAN = 'SELESAI' THEN +1 ELSE 0 END) as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM daftar_aset d LEFT OUTER JOIN pemeliharaan_aset p ON d.ID_ASET = p.ID_ASET JOIN detil_usulan_penghapusan dp ON dp.ID_ASET = d.ID_ASET WHERE dp.ID_PENGHAPUSAN = '".$id."'");
        // $query = mysqli_query($koneksi,"SELECT dp.ID_ASET, d.NAMA_ASET, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, (SELECT COUNT(ID_ASET) FROM pemeliharaan_aset WHERE ID_ASET = dp.ID_ASET AND STATUS_PEMELIHARAAN = 'Selesai') as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM detil_usulan_penghapusan dp JOIN daftar_aset d ON dp.ID_ASET = d.ID_ASET WHERE dp.ID_PENGHAPUSAN = '".$id."'");
        $query = mysqli_query($koneksi,"SELECT dp.ID_ASET, d.NAMA_BARANG, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, (SELECT COUNT(ID_ASET) FROM pemeliharaan_aset WHERE ID_ASET = dp.ID_ASET AND STATUS_PEMELIHARAAN = 'Selesai') as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM detil_usulan_penghapusan dp JOIN daftar_baru d ON dp.ID_ASET = d.ID_ASET WHERE dp.ID_PENGHAPUSAN = '".$id."'");
        
        while($row = mysqli_fetch_array($query)){
            $id_aset = $row['ID_ASET'];
            $nama_aset = $row['NAMA_BARANG'];
            $umur = $row['DIFF'];
            $jml_pemeliharaan = $row['JML_PEMELIHARAAN'];
            $bagi = ($row['HARGA_PEMBELIAN']-$row['NILAI_RESIDU'])/$row['MASA_MANFAAT'];
            $nilai = $row['HARGA_PEMBELIAN']-($bagi*($row['MASA_MANFAAT']-$row['DIFF']));
            
            //$add = array('no' => $a, 'id_aset' => $id_aset, 'nama' => $nama_aset, 'umur' => $umur, 'jumlah_pemeliharaan' => $jml_pemeliharaan, 'nilai' => $nilai);
            $add = array($a, $nama_aset, $umur." tahun", $jml_pemeliharaan." kali", asRupiah($nilai));
            array_push($myObj, $add);
            $a++;
        }
        
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }
    
    if(isset($_POST['penghapusan'])) {
        $id = $_POST['penghapusan'];
        //echo $id;
        $arr_aset = explode("|",$_POST['item_aset']);
        $arr_status = explode("|",$_POST['status']);
        print_r($arr_status);
        for($a = 0; $a < count($arr_aset); $a++){
            // $update = mysqli_query($koneksi, "UPDATE daftar_aset SET STATUS_ASET = '".$arr_status[$a]."' WHERE ID_ASET = '".$arr_aset[$a]."'");
            $update = mysqli_query($koneksi, "UPDATE daftar_baru SET STATUS_ASET = '".$arr_status[$a]."' WHERE ID_ASET = '".$arr_aset[$a]."'");
        }
    }

?>