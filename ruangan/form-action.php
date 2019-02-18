<?php
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $query = mysqli_query($koneksi, "INSERT INTO ruangan (nama_ruangan, kode_ruangan, status_ruangan) VALUES ('".$nama."','".$kode."','Aktif')");
        if($query) {
            header("location: ../ruangan/?success");
        }
        else {
        echo mysqli_error($koneksi);
        }
    }

    if(isset($_POST['edit'])) {
        $id = $_POST['id_ruangan'];
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $query = mysqli_query($koneksi, "UPDATE ruangan SET nama_ruangan = '".$nama."', kode_ruangan = '".$kode."' WHERE id_ruangan = ".$id."");
        if($query) {
            header("location: ../ruangan/?edit");
        }
        else {
        echo mysqli_error($koneksi);
        }
    }

    if(isset($_POST['edit'])) {
        $id = $_POST['id_ruangan'];
        $query = mysqli_query($koneksi, "UPDATE ruangan SET status_ruangan = 'Dihapus' WHERE id_ruangan = ".$id."");
        if($query) {
            header("location: ../ruangan/?delete");
        }
        else {
        echo mysqli_error($koneksi);
        }
    }
?>