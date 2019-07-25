<?php
    session_start();
    
    include "../connection.php";

    if(isset($_POST['simpan-usulan'])) {
        $keterangan = $_POST['keterangan'];
        $tanggal = date("Y-m-d H:i:s");
        if(empty($_SESSION['temp_hapus'])){
            $_SESSION['error-msg'] = "Tidak ada barang usulan";
            header("location: ../penghapusan/?error");
        }
        else {
            $id_pengadaan = randomID('penghapusan_aset', 'ID_PENGHAPUSAN', 10);
            echo $id_pengadaan."\n";
            ECHO "INSERT INTO penghapusan_aset (ID_PENGHAPUSAN, ID_USER, KETERANGAN_PENGHAPUSAN, TANGGAL_USULAN, HASIL_APPROVAL, STATUS_USULAN) VALUES ('".$id_pengadaan."','".$_SESSION['id_user']."','".$keterangan."','".$tanggal."','Pending','Aktif') \n";
            $query = mysqli_query($koneksi, "INSERT INTO penghapusan_aset (ID_PENGHAPUSAN, ID_USER, KETERANGAN_PENGHAPUSAN, TANGGAL_USULAN, HASIL_APPROVAL, STATUS_USULAN) VALUES ('".$id_pengadaan."','".$_SESSION['id_user']."','".$keterangan."','".$tanggal."','Pending','Aktif')");

            foreach ($_SESSION['temp_hapus'] as $key => $value) {
                # code...
                $id_detil_hapus = randomID('detil_usulan_penghapusan', 'ID_USULAN_HAPUS', 10);
                echo "INSERT INTO detil_usulan_penghapusan (ID_USULAN_HAPUS, ID_PENGHAPUSAN, ID_ASET) VALUES ('".$id_detil_hapus."','".$id_pengadaan."','".$value['id_aset']."') \n";
                $insert = mysqli_query($koneksi, "INSERT INTO detil_usulan_penghapusan (ID_USULAN_HAPUS, ID_PENGHAPUSAN, ID_ASET) VALUES ('".$id_detil_hapus."','".$id_pengadaan."','".$value['id_aset']."')");
                }

            if($query && $insert) {
                $_SESSION['success-msg'] = "Sukses menambah data usulan.";
                unset($_SESSION['temp_hapus']);
                $_SESSION['temp_hapus'] = array();
                
                $cek_data = mysqli_query($koneksi, "SELECT * FROM penghapusan_aset WHERE ID_USER = '".$_SESSION['id_user']."' AND HASIL_APPROVAL = 'Pending'");
                if(!isset($_SESSION['notifikasi-penghapusan'])){
                    $_SESSION['notifikasi-penghapusan'] = array();
                }
                while($baris = mysqli_fetch_array($cek_data)){
                    $add = array('id_penghapusan' => $baris['ID_PENGHAPUSAN'], 'status' => $baris['HASIL_APPROVAL']);
                    array_push($_SESSION['notifikasi-penghapusan'], $add);
                }
                header("location: ../penghapusan/?success");
            }
            else {
                $_SESSION['error-msg'] = mysqli_error($koneksi);
                header("location: ../penghapusan/?error");
            }
        }
    }


    if(isset($_POST['hapus_aset'])) {
        $id = $_POST['id_hapus'];
        //echo $id;
        $tgl = $_POST['tgl_penghapusan'];
        $date = str_replace('/', '-', $tgl);
        //echo $date."\n";
        $tgl_penghapusan = date("Y-m-d", strtotime($date));
        $arr_aset = $_POST['aset'];
        $arr_status = $_POST['status'];
        $query = mysqli_query($koneksi, "UPDATE penghapusan_aset SET TANGGAL_PENGHAPUSAN = '".$tgl_penghapusan."' WHERE ID_PENGHAPUSAN = '".$id."'");
        print_r($arr_status);
        for($a = 0; $a < count($arr_aset); $a++){
            echo "UPDATE daftar_aset SET STATUS_ASET = '".$arr_status[$a]."' WHERE ID_ASET = '".$arr_aset[$a]."' \n";
            $upd = mysqli_query($koneksi, "UPDATE detil_usulan_penghapusan SET CATATAN = '".$arr_status[$a]."' WHERE ID_ASET = '".$arr_aset[$a]."'");
            $update = mysqli_query($koneksi, "UPDATE daftar_aset SET STATUS_ASET = '".$arr_status[$a]."' WHERE ID_ASET = '".$arr_aset[$a]."'");
        }
        header("location:../penghapusan/?disposal");
    }

?>