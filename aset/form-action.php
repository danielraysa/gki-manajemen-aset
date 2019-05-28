<?php
    session_start();
    include "../connection.php";

    if(isset($_POST['edit'])) {
        $id_aset = $_POST['id_aset'];
        echo "id: ".$id_aset."<br>";
        $nama_aset = $_POST['nama'];
        $kode_aset = $_POST['kode'];
        
        $merk = $_POST['merk'];
        echo "merk: ".$merk."<br>";
        $serimodel = $_POST['serimodel'];
        $komisi = $_POST['komisi'];
        echo "komisi: ".$komisi."<br>";
        $ruangan = $_POST['ruangan_aset'];
        echo "ruangan: ".$ruangan."<br>";
        $status = $_POST['status'];
        echo "status: ".$status."<br>";
        
        //echo $new_tanggal;
        $pinjam = 0;
        if(isset($_POST['pinjam'])) {
            $pinjam = 1;
        }
        echo "pinjam = ".$pinjam."<br>";

        if(isset($_FILES['foto']['name'])){
            $newfilename = $_FILES['foto']['name'];
            $target_dir = "../gambar/aset/";
            $imageFileType = pathinfo($newfilename,PATHINFO_EXTENSION);
            $is_unique = false;
            while(!$is_unique) {
                $select = mysqli_query($koneksi, "SELECT * FROM daftar_aset WHERE FOTO_ASET = '".$newfilename."'");
                if(mysqli_num_rows($select) >= 1) {
                    $newfilename = uniqid();
                    $newfilename = $newfilename.".".$imageFileType;
                }
                else {
                    $is_unique = true;
                }
            }
            $target_file = $target_dir.basename($newfilename);
            $uploadOk = 1;
            if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)){
                echo "uploaded to server, filename : ".$newfilename;
            }
            echo "UPDATE daftar_aset SET ID_MERK = '".$merk."', ID_RUANGAN = '".$ruangan."', ID_KOMISI = '".$komisi."', ID_STATUS = '".$status."', NAMA_ASET = '".$nama_aset."', KODE_ASET = '".$kode_aset."', PERBOLEHAN_PINJAM = '".$pinjam."', FOTO_ASET = '".$newfilename."' WHERE ID_ASET = '".$id_aset."' <br>";

            $insert = mysqli_query($koneksi, "UPDATE daftar_aset SET ID_MERK = '".$merk."', ID_RUANGAN = '".$ruangan."', ID_KOMISI = '".$komisi."', ID_STATUS = '".$status."', NAMA_ASET = '".$nama_aset."', KODE_ASET = '".$kode_aset."', PERBOLEHAN_PINJAM = '".$pinjam."', FOTO_ASET = '".$newfilename."' WHERE ID_ASET = '".$id_aset."'");
        }    
        else {
            echo "UPDATE daftar_aset SET ID_MERK = '".$merk."', ID_RUANGAN = '".$ruangan."', ID_KOMISI = '".$komisi."', ID_STATUS = '".$status."', NAMA_ASET = '".$nama_aset."', KODE_ASET = '".$kode_aset."', PERBOLEHAN_PINJAM = '".$pinjam."' WHERE ID_ASET = '".$id_aset."' <br>";
            $insert = mysqli_query($koneksi, "UPDATE daftar_aset SET ID_MERK = '".$merk."', ID_RUANGAN = '".$ruangan."', ID_KOMISI = '".$komisi."', ID_STATUS = '".$status."', NAMA_ASET = '".$nama_aset."', KODE_ASET = '".$kode_aset."', PERBOLEHAN_PINJAM = '".$pinjam."' WHERE ID_ASET = '".$id_aset."'");
        }
    
        if($insert) {
            $_SESSION['success-msg'] = "Sukses mengubah data aset.";
            header("location: ../aset?edit");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../aset?error");
        }
    }

?>