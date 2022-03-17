<?php
    session_start();
    include "../connection.php";    
    
    if(isset($_POST['add_barang'])) {
        $nama = $_POST['nama'];
        $kategori = $_POST['kategori'];
        
        $random_id = randomID('barang', 'ID_BARANG', 10);
        $query = mysqli_query($koneksi, "INSERT INTO barang (ID_BARANG, NAMA_BARANG, ID_KATEGORI, STATUS_BARANG) VALUES ('".$random_id."', '".$nama."','".$kategori."','Aktif')");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data barang.";
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            echo $_SESSION['error-msg'];
        }
    }
    if(isset($_POST['add_merk'])) {
        $merk = $_POST['nama_merk'];
        $random_id = randomID('merk', 'ID_MERK', 6);
        $query = mysqli_query($koneksi, "INSERT INTO merk (ID_MERK, NAMA_MERK, STATUS_MERK) VALUES ('".$random_id."', '".$merk."','Aktif')");
        
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data merk.";
            echo $_SESSION['success-msg'];
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            echo $_SESSION['error-msg'];
        }
    }
    if(isset($_POST['add_ruangan'])) {
        $random_id = randomID('ruangan', 'ID_RUANGAN', 6);
        $nama = $_POST['nama_ruangan'];
        $kategori = $_POST['kode_ruangan'];
        $query = mysqli_query($koneksi, "INSERT INTO ruangan (ID_RUANGAN, NAMA_RUANGAN, KODE_RUANGAN, STATUS_RUANGAN) VALUES ('".$random_id."', '".$nama."','".$kategori."','Aktif')");
        
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data ruangan.";
            echo $_SESSION['success-msg'];
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            echo $_SESSION['error-msg'];
        }
    }
    if(isset($_POST['add_komisi'])) {
        $nama = $_POST['nama_komisi'];
        $kategori = $_POST['kode_komisi'];
        $random_id = randomID('komisi_jemaat', 'ID_KOMISI', 6);
        $query = mysqli_query($koneksi, "INSERT INTO komisi_jemaat (ID_KOMISI, NAMA_KOMISI, KODE_KOMISI, STATUS_KOMISI) VALUES ('".$random_id."', '".$nama."','".$kategori."','Aktif')");
        
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data komisi jemaat.";
            echo $_SESSION['success-msg'];
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            echo $_SESSION['error-msg'];
        }
    }

    // kosongin item
    if(isset($_POST['empty'])){
        unset($_SESSION['temp_item']);
        unset($_SESSION['temp_item_2']);
        header("location:../pengadaan");
    }
    
    // approve pengadaan
    if (isset($_GET['approve'])) {
        $id = $_GET['approve'];
        $date = date('Y-m-d H:i:s');
        $query = mysqli_query($koneksi, "UPDATE pengadaan_aset SET HASIL_APPROVAL = 'Diterima', TANGGAL_APPROVE = '".$date."' WHERE ID_PENGADAAN = '".$id."'");
        $insert = mysqli_query($koneksi, "INSERT INTO notifikasi(TABEL_REF, ID_REF, TGL_NOTIF, READ_NOTIF) VALUES ('pengadaan_aset', '".$id."', '".$date."', 0)");
        $log = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG, ID_REF, ACTIVITY_DETAIL) VALUES ('".$_SESSION['id_user']."','".$date."', 'pengadaan', '".$id."','terima_pengadaan')");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
    }

    if (isset($_GET['reject'])) {
        $id = $_GET['reject'];
        $keterangan = $_GET['keterangan'];
        $date = date('Y-m-d H:i:s');
        $query = mysqli_query($koneksi, "UPDATE pengadaan_aset SET HASIL_APPROVAL = 'Ditolak', TANGGAL_APPROVE = '".$date."', CATATAN_APPROVAL = '".$keterangan."' WHERE ID_PENGADAAN = '".$id."'");
        $insert = mysqli_query($koneksi, "INSERT INTO notifikasi(TABEL_REF, ID_REF, TGL_NOTIF, READ_NOTIF) VALUES ('pengadaan_aset', '".$id."', '".$date."', 0)");
        $log = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG, ID_REF, ACTIVITY_DETAIL) VALUES ('".$_SESSION['id_user']."','".$date."', 'pengadaan', '".$id."','tolak_pengadaan')");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }    
    }
    if (isset($_POST['delete-usulan'])) {
        $id = $_POST['delete-usulan'];
        $date = date('Y-m-d H:i:s');
        $query = mysqli_query($koneksi, "UPDATE pengadaan_aset SET STATUS_USULAN = 'Dihapus' WHERE ID_PENGADAAN = '".$id."'");
        $log = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG, ID_REF, ACTIVITY_DETAIL) VALUES ('".$_SESSION['id_user']."','".$date."', 'pengadaan', '".$id."','hapus_usulan')");
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
        // $query = mysqli_query($koneksi, "SELECT p.barang_usulan, b.nama_barang, p.harga FROM detil_usulan_pengadaan p JOIN barang b ON p.id_barang = b.id_barang WHERE p.id_pengadaan = '".$id."'");
        $query = mysqli_query($koneksi, "SELECT barang_usulan, harga, keterangan FROM detil_usulan_pengadaan WHERE id_pengadaan = '".$id."'");
        while($row = mysqli_fetch_array($query)){
            $nama = $row['barang_usulan'];
            $keterangan = $row['keterangan'];
            $harga = str_replace(',','.',asRupiah($row['harga']));
            //$array = array('nomor' => $a, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga);
            $array = array($a, $nama, $harga, $keterangan);
            array_push($myObj, $array);
            $a++;
        }
        //$myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga, 'keterangan' => $keterangan);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }
    
    if(isset($_POST['id-insert'])) {
        $id = $_POST['id-insert'];
        // $query = mysqli_query($koneksi, "SELECT p.barang_usulan, p.id_barang, b.nama_barang, p.harga FROM detil_usulan_pengadaan p JOIN barang b ON p.id_barang = b.id_barang WHERE p.id_usulan_tambah = '".$id."'");
        $query = mysqli_query($koneksi, "SELECT p.barang_usulan, p.harga FROM detil_usulan_pengadaan p WHERE p.id_usulan_tambah = '".$id."'");
        $row = mysqli_fetch_array($query);
        $nama = $row['barang_usulan'];
        // $barang = $row['id_barang'];
        $harga = $row['harga'];
        // $myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga);
        $myObj = array('id' => $id, 'nama' => $nama, 'harga' => $harga);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

    if(isset($_POST['counter_barang'])){
        $id = $_POST['counter_barang'];
        $query = mysqli_query($koneksi, "SELECT count(*)+1 as counter FROM daftar_baru WHERE JENIS_BARANG = '".$id."'");
        $row = mysqli_fetch_array($query);
        $counter = $row['counter'];
        if($counter < 10){
            $counter = "000".$counter;
        }else if($counter < 100){
            $counter = "00".$counter;
        }else if($counter < 1000){
            $counter = "0".$counter;
        }else{
            $counter = "".$counter;
        }
        echo $counter;
    }

    if(isset($_POST['counter_komisi'])){
        $id = $_POST['counter_komisi'];
        $query = mysqli_query($koneksi, "SELECT count(*)+1 as counter FROM daftar_baru WHERE KODE_KOMISI = '".$id."'");
        $row = mysqli_fetch_array($query);
        $counter = $row['counter'];
        if($counter < 10){
            $counter = "000".$counter;
        }else if($counter < 100){
            $counter = "00".$counter;
        }else if($counter < 1000){
            $counter = "0".$counter;
        }else{
            $counter = "".$counter;
        }
        echo $counter;
    }

?>