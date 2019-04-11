<?php
    session_start();
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $random_id = randString(10);
        $is_unique = false;
        while (!$is_unique) {
            $select = mysqli_query($koneksi, "SELECT * FROM status WHERE ID_STATUS = '".$random_id."'");
            if (mysqli_num_rows($select) == 0) {  
                // if you don't get a result, then you're good
                $is_unique = true;
                $query = mysqli_query($koneksi, "INSERT INTO status (ID_STATUS, NAMA_STATUS) VALUES ('".$random_id."','".$nama."')");
            }
            else {
                $random_id = randString(10);
            }
        }
        // $query = mysqli_query($koneksi, "INSERT INTO status (NAMA_STATUS, status) VALUES ('".$nama."', 'Aktif')");
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
        $query = mysqli_query($koneksi, "UPDATE status SET NAMA_STATUS = '".$nama."', WHERE ID_STATUS = ".$id."");
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