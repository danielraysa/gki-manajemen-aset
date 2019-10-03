<?php
    session_start();
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $random_id = randomID('kategori', 'ID_KATEGORI', 10);
        $query = mysqli_query($koneksi, "INSERT INTO kategori (ID_KATEGORI, NAMA_KATEGORI, KODE_KATEGORI, STATUS_KATEGORI) VALUES ('".$random_id."','".$nama."','".$kode."','Aktif')");        
        
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data.";
            header("location: ../kategori/?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../kategori/?error");
        }
    }

    if(isset($_POST['edit'])) {
        $id = $_POST['id_kategori'];
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $query = mysqli_query($koneksi, "UPDATE kategori SET NAMA_KATEGORI = '".$nama."', KODE_KATEGORI = '".$kode."' WHERE ID_KATEGORI = '".$id."'");
        if($query) {
            $_SESSION['success-msg'] = "Sukses mengubah data.";
            header("location: ../kategori/?edit");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../kategori/?error");
        }
    }

    if(isset($_POST['delete'])) {
        $id = $_POST['id_kategori'];
        $query = mysqli_query($koneksi, "UPDATE kategori SET status_kategori = 'Dihapus' WHERE id_kategori = '".$id."'");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menghapus data.";
            header("location: ../kategori/?delete");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../kategori/?error");
        }
    }
?>