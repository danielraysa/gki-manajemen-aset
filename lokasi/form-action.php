<?php
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $random_id = randomID('lokasi', 'ID_LOKASI', 6);
        $query = mysqli_query($koneksi, "INSERT INTO lokasi (ID_LOKASI, NAMA_LOKASI, KODE_LOKASI, STATUS_LOKASI) VALUES ('".$random_id."','".$nama."','".$kode."','Aktif')");
        
        if($query) {
            header("location: ../lokasi/?success");
        }
        else {
            echo mysqli_error($koneksi);
        }
    }

    if(isset($_POST['edit'])) {
        $id = $_POST['id_lokasi'];
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $query = mysqli_query($koneksi, "UPDATE lokasi SET NAMA_LOKASI = '".$nama."', KODE_LOKASI = '".$kode."' WHERE ID_LOKASI = '".$id."'");
        if($query) {
            header("location: ../lokasi/?edit");
        }
        else {
            echo mysqli_error($koneksi);
        }
    }

    if(isset($_POST['delete'])) {
        $id = $_POST['id_lokasi'];
        $query = mysqli_query($koneksi, "UPDATE lokasi SET STATUS_LOKASI = 'Dihapus' WHERE ID_LOKASI = '".$id."'");
        if($query) {
            header("location: ../lokasi/?delete");
        }
        else {
            echo mysqli_error($koneksi);
        }
    }
?>