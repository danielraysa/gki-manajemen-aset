<?php
    session_start();
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hak_akses = $_POST['hak_akses'];
        //$keterangan = $_POST['keterangan'];
        $random_id = randString(10);
        $is_unique = false;
        while (!$is_unique) {
            $select = mysqli_query($koneksi, "SELECT * FROM user WHERE ID_USER = '".$random_id."'");
            if (mysqli_num_rows($select) == 0) {  
                // if you don't get a result, then you're good
                $is_unique = true;
                $query = mysqli_query($koneksi, "INSERT INTO user (ID_USER,USERNAME, PASSWORD, NAMA_LENGKAP, ROLE, STATUS_USER) VALUES ('".$random_id."','".$username."','".$password."','".$nama."','".$hak_akses."','Aktif')");
            }
            else {
                $random_id = randString(10);
            }
        }
        
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
        //$keterangan = $_POST['keterangan'];
        $query = mysqli_query($koneksi, "UPDATE user SET NAMA_LENGKAP = '".$nama."', USERNAME = '".$username."', PASSWORD = '".$password."', ROLE = '".$hak_akses."' WHERE ID_USER = '".$id."'");
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