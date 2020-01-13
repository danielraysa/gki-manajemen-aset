<?php
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $random_id = randomID('komisi_jemaat', 'ID_KOMISI', 6);
        
        $query = mysqli_query($koneksi, "INSERT INTO komisi_jemaat (ID_KOMISI, NAMA_KOMISI, KODE_KOMISI, STATUS_KOMISI) VALUES ('".$random_id."','".$nama."','".$kode."','Aktif')");
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
        $query = mysqli_query($koneksi, "UPDATE komisi_jemaat SET NAMA_KOMISI = '".$nama."', KODE_KOMISI = '".$kode."' WHERE ID_KOMISI = '".$id."'");
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
        $query = mysqli_query($koneksi, "UPDATE komisi SET STATUS_KOMISI = 'Dihapus' WHERE ID_KOMISI = '".$id."'");
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