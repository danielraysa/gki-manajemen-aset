<?php
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hak_akses = $_POST['hak_akses'];
        $keterangan = $_POST['keterangan'];
        $query = mysqli_query($koneksi, "INSERT INTO users (username, password, nama, role, keterangan, status_user) VALUES ('".$username."','".$password."','".$nama."','".$hak_akses."','".$keterangan."','Aktif')");
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
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hak_akses = $_POST['hak_akses'];
        $keterangan = $_POST['keterangan'];
        $query = mysqli_query($koneksi, "UPDATE users SET nama = '".$nama."', username = '".$username."', password = '".$password."', role = '".$hak_akses."', keterangan = '".$keterangan."' WHERE id = ".$id."");
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
        $query = mysqli_query($koneksi, "UPDATE users SET status_user = 'Dihapus' WHERE id = ".$id."");
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