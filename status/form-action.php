<?php
    session_start();
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        
        $query = mysqli_query($koneksi, "INSERT INTO status (nama_status, status) VALUES ('".$nama."', 'Aktif')");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data.";
            header("location: ../status/?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../status/?error");
        }
    }

    if(isset($_POST['edit'])) {
        $id = $_POST['id_status'];
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $query = mysqli_query($koneksi, "UPDATE status SET nama_status = '".$nama."', WHERE id_status = ".$id."");
        if($query) {
            $_SESSION['success-msg'] = "Sukses mengubah data.";
            header("location: ../status/?edit");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../status/?error");
        }
    }

    if(isset($_POST['delete'])) {
        $id = $_POST['id_status'];
        $query = mysqli_query($koneksi, "UPDATE status SET status = 'Dihapus' WHERE id_status = ".$id."");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menghapus data.";
            header("location: ../status/?delete");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../status/?error");
        }
    }
?>