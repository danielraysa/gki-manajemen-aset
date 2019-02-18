<?php
    session_start();
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $kategori = $_POST['kategori'];
        $merk = $_POST['merk'];
        $serimodel = $_POST['serimodel'];
        $query = mysqli_query($koneksi, "INSERT INTO barang (nama_barang, id_kategori, merk, seri_model, status_barang) VALUES ('".$nama."',".$kategori.",'".$merk."','".$serimodel."','Aktif')");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data.";
            header("location: ../barang/?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../barang/?error");
        }
    }

    if(isset($_POST['edit'])) {
        $id = $_POST['id_barang'];
        $nama = $_POST['nama'];
        $kategori = $_POST['kategori'];
        $merk = $_POST['merk'];
        $serimodel = $_POST['serimodel'];
        $query = mysqli_query($koneksi, "UPDATE barang SET nama_barang = '".$nama."', id_kategori = ".$kategori.", merk = '".$merk."', seri_model = '".$serimodel."' WHERE id_barang = ".$id."");
        if($query) {
            $_SESSION['success-msg'] = "Sukses mengubah data.";
            header("location: ../barang/?edit");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../barang/?error");
        }
    }

    if(isset($_POST['delete'])) {
        $id = $_POST['id_barang'];
        $query = mysqli_query($koneksi, "UPDATE barang SET status_barang = 'Dihapus' WHERE id_barang = ".$id."");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menghapus data.";
            header("location: ../barang/?delete");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../barang/?error");
        }
    }
?>