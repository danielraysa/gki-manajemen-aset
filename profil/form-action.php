<?php
    session_start();
    include "../connection.php";    

    if(isset($_POST['edit'])) {
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        
        //$keterangan = $_POST['keterangan'];
        if(isset($_FILES['foto']['name'])){
            $newfilename = $_FILES['foto']['name'];
            $target_dir = "../gambar/user/";
            $target_file = $target_dir.basename($newfilename);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $check = mysqli_query($koneksi, "SELECT * FROM user WHERE foto_user = '".$newfilename."'");
            if(mysqli_num_rows($check) > 0) {
                $newfilename = randString(10).".".$imageFileType;
            }
            if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)){
                echo "uploaded to server, filename : ".$newfilename;
                $query = mysqli_query($koneksi, "UPDATE user SET foto_user = '".$newfilename."' WHERE id_user = '".$_SESSION['id_user']."'");
            }
        }

        $query = mysqli_query($koneksi, "UPDATE user SET nama_lengkap = '".$nama."', username = '".$username."' WHERE id_user = '".$_SESSION['id_user']."'");
        if(isset($_POST['password'])){
            $password = $_POST['password'];
            $change = mysqli_query($koneksi, "UPDATE user SET password = '".$password."' WHERE id_user = '".$_SESSION['id_user']."'");
        }
        if($query) {
            $_SESSION['success-msg'] = "Sukses mengubah data.";
            header("location: ../profil/?edit");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../profil/?error");
        }
    }
?>