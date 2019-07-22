<?php
    session_start();
    include "../connection.php";    

    if(isset($_POST['edit'])) {
        $nama = $_POST['nama'];
        $username = $_POST['alamat'];
        $password = $_POST['notelp'];
        $hak_akses = $_POST['nama_web'];
        //$keterangan = $_POST['keterangan'];
        $query = mysqli_query($koneksi, "UPDATE konfigurasi SET nama_gereja = '".$nama."', alamat_gereja = '".$username."', no_telp = '".$password."', nama_web = '".$hak_akses."'");
        if($query) {
            $_SESSION['success-msg'] = "Sukses mengubah data.";
            header("location: ../konfigurasi/?edit");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../konfigurasi/?error");
        }
    }
?>