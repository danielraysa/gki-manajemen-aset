<?php
    session_start();
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $kategori = $_POST['kategori'];
        //$merk = $_POST['merk'];
        //$serimodel = $_POST['serimodel'];
        $random_id = randomID('barang', 'ID_BARANG', 10);
        $query = mysqli_query($koneksi, "INSERT INTO barang (ID_BARANG, NAMA_BARANG, ID_KATEGORI, STATUS_BARANG) VALUES ('".$random_id."', '".$nama."','".$kategori."','Aktif')");
        
        //$query = mysqli_query($koneksi, "INSERT INTO barang (nama_barang, id_kategori, merk, seri_model, status_barang) VALUES ('".$nama."',".$kategori.",'".$merk."','".$serimodel."','Aktif')");
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
        //$merk = $_POST['merk'];
        //$serimodel = $_POST['serimodel'];
        //echo "UPDATE barang SET NAMA_BARANG = '".$nama."', ID_KATEGORI = '".$kategori."' WHERE ID_BARANG = '".$id."'";
        $query = mysqli_query($koneksi, "UPDATE barang SET NAMA_BARANG = '".$nama."', ID_KATEGORI = '".$kategori."' WHERE ID_BARANG = '".$id."'");
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
        $query = mysqli_query($koneksi, "UPDATE barang SET STATUS_BARANG = 'Dihapus' WHERE ID_BARANG = '".$id."'");
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