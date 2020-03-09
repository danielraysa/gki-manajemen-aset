<?php
    session_start();
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hak_akses = $_POST['hak_akses'];
        $no_hp = $_POST['no_hp'];
        //$keterangan = $_POST['keterangan'];
        $random_id = randomID('user', 'ID_USER', 10);
        $query = mysqli_query($koneksi, "INSERT INTO user (ID_USER, USERNAME, PASSWORD, NAMA_LENGKAP, ROLE, NO_HP, STATUS_USER) VALUES ('".$random_id."','".$username."','".$password."','".$nama."','".$hak_akses."','".$no_hp."','Aktif')");
        
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data.";
            header("location: ../user/?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../user/?error");
        }
    }

    if(isset($_POST['edit'])) {
        $id = $_POST['id_user'];
        $nama = $_POST['nama'];
        $password = $_POST['password'];
        $username = $_POST['username'];
        $hak_akses = $_POST['hak_akses'];
        $no_hp = $_POST['no_hp'];
        //$keterangan = $_POST['keterangan'];
        if($password != ""){
            $query = mysqli_query($koneksi, "UPDATE user SET NAMA_LENGKAP = '".$nama."', USERNAME = '".$username."', PASSWORD = '".$password."', ROLE = '".$hak_akses."', NO_HP = '".$no_hp."' WHERE ID_USER = '".$id."'");
        }
        else{
            $query = mysqli_query($koneksi, "UPDATE user SET NAMA_LENGKAP = '".$nama."', USERNAME = '".$username."', ROLE = '".$hak_akses."', NO_HP = '".$no_hp."' WHERE ID_USER = '".$id."'");
        }
        if($query) {
            $_SESSION['success-msg'] = "Sukses mengubah data.";
            header("location: ../user/?edit");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../user/?error");
        }
    }

    if(isset($_POST['delete'])) {
        $id = $_POST['id_user'];
        $query = mysqli_query($koneksi, "UPDATE user SET STATUS_USER = 'Dihapus' WHERE ID_USER = '".$id."'");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menghapus data.";
            header("location: ../user/?delete");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../user/?error");
        }
    }
?>