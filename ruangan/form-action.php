<?php
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $random_id = randomID('ruangan', 'ID_RUANGAN', 6);
        $query = mysqli_query($koneksi, "INSERT INTO ruangan (ID_RUANGAN, NAMA_RUANGAN, KODE_RUANGAN, STATUS_RUANGAN) VALUES ('".$random_id."','".$nama."','".$kode."','Aktif')");
        
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
        $query = mysqli_query($koneksi, "UPDATE ruangan SET NAMA_RUANGAN = '".$nama."', KODE_RUANGAN = '".$kode."' WHERE ID_RUANGAN = '".$id."'");
        if($query) {
            header("location: ../ruangan/?edit");
        }
        else {
        echo mysqli_error($koneksi);
        }
    }

    if(isset($_POST['delete'])) {
        $id = $_POST['id_ruangan'];
        $query = mysqli_query($koneksi, "UPDATE ruangan SET STATUS_RUANGAN = 'Dihapus' WHERE ID_RUANGAN = '".$id."'");
        if($query) {
            header("location: ../ruangan/?delete");
        }
        else {
        echo mysqli_error($koneksi);
        }
    }
?>