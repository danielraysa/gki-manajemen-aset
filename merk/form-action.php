<?php
    session_start();
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $merk = $_POST['merk'];
        $random_id = randomID('merk', 'ID_MERK', 6);
        $query = mysqli_query($koneksi, "INSERT INTO merk(ID_MERK, NAMA_MERK, STATUS_MERK) VALUES ('".$random_id."', '".$merk."', 'Aktif')");
            
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data.";
            header("location: ../merk/?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../merk/?error");
        }
    }

    if(isset($_POST['edit'])) {
        $id = $_POST['id_merk'];
        $merk = $_POST['merk'];
        $query = mysqli_query($koneksi, "UPDATE merk SET NAMA_MERK = '".$merk."' WHERE ID_MERK = '".$id."'");
        if($query) {
            $_SESSION['success-msg'] = "Sukses mengubah data.";
            header("location: ../merk/?edit");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../merk/?error");
        }
    }

    if(isset($_POST['delete'])) {
        $id = $_POST['id_merk'];
        $query = mysqli_query($koneksi, "UPDATE merk SET STATUS_MERK = 'Dihapus' WHERE ID_MERK = '".$id."'");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menghapus data.";
            header("location: ../merk/?delete");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../merk/?error");
        }
    }
?>