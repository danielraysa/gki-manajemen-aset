<?php
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $query = mysqli_query($koneksi, "INSERT INTO komisi (nama_komisi, kode_komisi, status_komisi) VALUES ('".$nama."','".$kode."','Aktif')");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data.";
            header("location: ../komisi/?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../komisi/?error");
        }
    }

    if(isset($_POST['edit'])) {
        $id = $_POST['id_komisi'];
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $query = mysqli_query($koneksi, "UPDATE komisi SET nama_komisi = '".$nama."', kode_komisi = '".$kode."' WHERE id_komisi = ".$id."");
        if($query) {
            $_SESSION['success-msg'] = "Sukses mengubah data.";
            header("location: ../komisi/?edit");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../komisi/?error");
        }
    }

    if(isset($_POST['delete'])) {
        $id = $_POST['id_komisi'];
        $query = mysqli_query($koneksi, "UPDATE komisi SET status_komisi = 'Dihapus' WHERE id_komisi = ".$id."");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menghapus data.";
            header("location: ../komisi/?delete");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../komisi/?error");
        }
    }
?>