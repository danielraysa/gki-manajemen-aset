<?php
    session_start();
    include "../connection.php";    

    if(isset($_POST['edit'])) {
        $nama = $_POST['nama'];
        $username = $_POST['alamat'];
        $password = $_POST['notelp'];
        $hak_akses = $_POST['nama_web'];
        //$keterangan = $_POST['keterangan'];
        if(isset($_FILES['print']['name'])){
            $newfilename = $_FILES['print']['name'];
            $target_dir = "../gambar/konfig/";
            $target_file = $target_dir.basename($newfilename);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $check = mysqli_query($koneksi, "SELECT * FROM konfigurasi WHERE logo_web = '".$newfilename."' OR logo_icon = '".$newfilename."'");
            if(mysqli_num_rows($check) > 0) {
                $newfilename = randString(10).".".$imageFileType;
            }
            if(move_uploaded_file($_FILES['print']['tmp_name'], $target_file)){
                echo "uploaded to server, filename : ".$newfilename;
                $query = mysqli_query($koneksi, "UPDATE konfigurasi SET logo_print = '".$newfilename."'");
            }
        }
        if(isset($_FILES['logo']['name'])){
            $newfilename = $_FILES['logo']['name'];
            $target_dir = "../gambar/konfig/";
            $target_file = $target_dir.basename($newfilename);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $check = mysqli_query($koneksi, "SELECT * FROM konfigurasi WHERE logo_print = '".$newfilename."' OR logo_icon = '".$newfilename."'");
            if(mysqli_num_rows($check) > 0) {
                $newfilename = randString(10).".".$imageFileType;
                $target_file = $target_dir.basename($newfilename);
            }
            if(move_uploaded_file($_FILES['logo']['tmp_name'], $target_file)){
                echo "uploaded to server, filename : ".$newfilename;
                $query = mysqli_query($koneksi, "UPDATE konfigurasi SET logo_web = '".$newfilename."'");
            }
        }
        if(isset($_FILES['icon']['name'])){
            $newfilename = $_FILES['icon']['name'];
            $target_dir = "../gambar/konfig/";
            $target_file = $target_dir.basename($newfilename);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $check = mysqli_query($koneksi, "SELECT * FROM konfigurasi WHERE logo_web = '".$newfilename."' OR logo_print = '".$newfilename."'");
            if(mysqli_num_rows($check) > 0) {
                $newfilename = randString(10).".".$imageFileType;
            }
            if(move_uploaded_file($_FILES['icon']['tmp_name'], $target_file)){
                echo "uploaded to server, filename : ".$newfilename;
                $query = mysqli_query($koneksi, "UPDATE konfigurasi SET logo_icon = '".$newfilename."'");
            }
        }

        $query = mysqli_query($koneksi, "UPDATE konfigurasi SET nama_gereja = '".$nama."', alamat_gereja = '".$username."', no_telp = '".$password."', nama_web = '".$hak_akses."'");
        if($query) {
            $_SESSION['success-msg'] = "Sukses mengubah data.";
            header("location: ../konfigurasi/?edit");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../konfigurasi/?error");
        }
    }
?>