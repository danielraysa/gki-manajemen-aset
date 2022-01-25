<?php
    session_start();
    include "../connection.php";

    if(isset($_POST['edit'])) {
        $id_jemaat = !isset($_POST['id_jemaat']) ? null : $_POST['id_jemaat'];
        /* $no_induk = !isset($_POST['no_induk']) ? null : $_POST['no_induk'];
        $nama_lengkap = !isset($_POST['nama_lengkap']) ? null : $_POST['nama_lengkap'];
        $jenis_kelamin = !isset($_POST['jenis_kelamin']) ? null : $_POST['jenis_kelamin'];
        $alamat = !isset($_POST['alamat']) ? null : $_POST['alamat'];
        $gol_darah = !isset($_POST['gol_darah']) ? null : $_POST['gol_darah'];
        $pekerjaan = !isset($_POST['pekerjaan']) ? null : $_POST['pekerjaan'];
        $tanggal_pernikahan = !isset($_POST['tanggal_pernikahan']) ? null : $_POST['tanggal_pernikahan'];
        $tempat_lahir = !isset($_POST['tempat_lahir']) ? null : $_POST['tempat_lahir'];
        $tanggal_lahir = !isset($_POST['tanggal_lahir']) ? null : $_POST['tanggal_lahir'];
        $kelompok_jemaat = !isset($_POST['kelompok_jemaat']) ? null : $_POST['kelompok_jemaat'];
        $baptis_tempat = !isset($_POST['baptis_tempat']) ? null : $_POST['baptis_tempat'];
        $baptis_tanggal = !isset($_POST['baptis_tanggal']) ? null : $_POST['baptis_tanggal'];
        $sidi_tempat = !isset($_POST['sidi_tempat']) ? null : $_POST['sidi_tempat'];
        $sidi_tanggal = !isset($_POST['sidi_tanggal']) ? null : $_POST['sidi_tanggal'];
        $atestasi_masuk_asal = !isset($_POST['atestasi_masuk_asal']) ? null : $_POST['atestasi_masuk_asal'];
        $atestasi_masuk_tanggal = !isset($_POST['atestasi_masuk_tanggal']) ? null : $_POST['atestasi_masuk_tanggal'];
        $atestasi_keluar_tujuan = !isset($_POST['atestasi_keluar_tujuan']) ? null : $_POST['atestasi_keluar_tujuan'];
        $atestasi_keluar_tanggal = !isset($_POST['atestasi_keluar_tanggal']) ? null : $_POST['atestasi_keluar_tanggal'];
        $status_meninggal = !isset($_POST['meninggal']) ? null : $_POST['meninggal'];
        $no_telp = !isset($_POST['no_telp']) ? null : $_POST['no_telp'];
        $email = !isset($_POST['email']) ? null : $_POST['email'];
        $keluar = !isset($_POST['keluar']) ? null : $_POST['keluar']; */
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