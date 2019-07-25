<?php
    session_start();
    
    include "../connection.php";    

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $barang = $_POST['barang'];
        //$jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $keterangan = $_POST['keterangan'];
        $tanggal = date("Y-m-d H:i:s");
        
        //$query = mysqli_query($koneksi, "INSERT INTO pengadaan (barang_usulan, id_barang, jumlah, harga, keterangan_usulan, tanggal_usulan, tanggal_modifikasi, hasil_approval, status_usulan) VALUES ('".$nama."',".$barang.",".$jumlah.",".$harga.",'".$keterangan."','".$tanggal."','".$tanggal."','Pending','Aktif')");
        $query = mysqli_query($koneksi, "INSERT INTO pengadaan (barang_usulan, id_barang, harga, keterangan_usulan, tanggal_usulan, tanggal_modifikasi, hasil_approval, status_usulan) VALUES ('".$nama."',".$barang.",".$harga.",'".$keterangan."','".$tanggal."','".$tanggal."','Pending','Aktif')");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data usulan.";
            header("location: ../pengadaan/?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../pengadaan/?error");
        }
    }

    if(isset($_POST['edit'])) {
        $id = $_POST['id_pengadaan'];
        $nama = $_POST['nama'];
        $barang = $_POST['barang'];
        //$jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $keterangan = $_POST['keterangan'];
        $tanggal = date("Y-m-d H:i:s");
        //$query = mysqli_query($koneksi, "UPDATE pengadaan SET barang_usulan = '".$nama."', id_barang = ".$barang.", jumlah = ".$jumlah.", harga = ".$harga.", keterangan = '".$keterangan."', tanggal_modifikasi = '".$tanggal."' WHERE id_pengadaan = ".$id."");
        $query = mysqli_query($koneksi, "UPDATE pengadaan SET barang_usulan = '".$nama."', id_barang = ".$barang.", harga = ".$harga.", keterangan = '".$keterangan."', tanggal_modifikasi = '".$tanggal."' WHERE id_pengadaan = ".$id."");
        if($query) {
            $_SESSION['success-msg'] = "Sukses mengubah data.";
            header("location: ../pengadaan/?edit");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../pengadaan/?error");
        }
    }

    if(isset($_POST['delete'])) {
        $id = $_POST['id_pengadaan'];
        $query = mysqli_query($koneksi, "UPDATE pengadaan SET status_usulan = 'Dihapus' WHERE id_pengadaan = ".$id."");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menghapus data.";
            header("location: ../pengadaan/?delete");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../pengadaan/?error");
        }
    }
?>