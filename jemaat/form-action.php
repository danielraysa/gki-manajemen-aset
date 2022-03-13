<?php
    session_start();
    include "../connection.php";

    if(isset($_POST['edit'])) {
        $id_jemaat = !isset($_POST['id_jemaat']) ? null : $_POST['id_jemaat'];
        $update_data = false;
        if($id_jemaat == null){ // insert data
            // $sql = "INSERT INTO data_jemaat(no_induk, nama_lengkap, jenis_kelamin, alamat, gol_darah, pekerjaan, tanggal_pernikahan, tempat_lahir, tanggal_lahir, kelompok_jemaat, baptis_tempat, baptis_tanggal, sidi_tempat, sidi_tanggal, atestasi_masuk_asal, atestasi_masuk_tanggal, atestasi_keluar_tujuan, atestasi_keluar_tanggal, status_meninggal, no_telp, email, keluar) VALUES ('".$no_induk."','".$nama_lengkap."','".$jenis_kelamin."','".$alamat."','".$gol_darah."','".$pekerjaan."','".$tanggal_pernikahan."','".$tempat_lahir."','".$tanggal_lahir."','".$kelompok_jemaat."','".$baptis_tempat."','".$baptis_tanggal."','".$sidi_tempat."','".$sidi_tanggal."','".$atestasi_masuk_asal."','".$atestasi_masuk_tanggal."','".$atestasi_keluar_tujuan."','".$atestasi_keluar_tanggal."','".$status_meninggal."','".$no_telp."','".$email."','".$keluar."')";
            $column = array();
            $params = array();
            foreach ($_POST as $key => $value) {
                if($value != null || $value != ''){
                    array_push($column, $key);
                    array_push($params, "'".$value."'");
                }
            }
            $sql = "INSERT INTO data_jemaat (".implode(', ',$column).") VALUES (".implode(', ',$params).")";
        }else{
            $update_data = true;
            // $sql = "UPDATE data_jemaat SET no_induk = '".$no_induk."',nama_lengkap = '".$nama_lengkap."',jenis_kelamin = '".$jenis_kelamin."',alamat = '".$alamat."',gol_darah = '".$gol_darah."',pekerjaan = '".$pekerjaan."',tanggal_pernikahan = '".$tanggal_pernikahan."',tempat_lahir = '".$tempat_lahir."',tanggal_lahir = '".$tanggal_lahir."',kelompok_jemaat = '".$kelompok_jemaat."',baptis_tempat = '".$baptis_tempat."',baptis_tanggal = '".$baptis_tanggal."',sidi_tempat = '".$sidi_tempat."',sidi_tanggal = '".$sidi_tanggal."',atestasi_masuk_asal = '".$atestasi_masuk_asal."',atestasi_masuk_tanggal = '".$atestasi_masuk_tanggal."',atestasi_keluar_tujuan = '".$atestasi_keluar_tujuan."',atestasi_keluar_tanggal = '".$atestasi_keluar_tanggal."',status_meninggal = '".$status_meninggal."',no_telp = '".$no_telp."',email = '".$email."',keluar = '".$keluar."' WHERE id_jemaat = $id_jemaat";
            $params = array();
            foreach ($_POST as $key => $value) {
                if(($value != null || $value != '') && $key != 'id_jemaat'){
                    array_push($params, $key ." = '".$value."'");
                }
            }
            $sql = "UPDATE data_jemaat SET ".implode(', ',$params)." WHERE id_jemaat = ".$id_jemaat."";
        }
        // echo "<pre>$sql</pre>";
        // exit;
        $query = mysqli_query($koneksi, $sql);
    
        if($query) {
            $message = "Sukses menambah data.";
            $status = "success";
            if($update_data){
                $message = "Sukses memperbarui data.";
                $status = "edit";
            }
            $_SESSION['success-msg'] = $message;
            header("location: ../jemaat?$status");
            exit;
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../jemaat?error");
            exit;
        }
    }

?>