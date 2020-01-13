<?php
    session_start();
    
    include "../connection.php";

    function formatNumber($nbr){
        if ($nbr < 10) {
            return "00".$nbr;
        }
        elseif ($nbr >= 10 && $nbr < 100 ){
            return "0".$nbr;
        }
        else{
            return strval($nbr);
        }
    }

    /* if(isset($_POST['add-barang'])) {
        $nama = $_POST['nama'];
        $kategori = $_POST['kategori'];
        $random_id = randString(10);
        $is_unique = false;
        while (!$is_unique) {
            $select = mysqli_query($koneksi, "SELECT * FROM barang WHERE ID_BARANG = '".$random_id."'");
            if (mysqli_num_rows($select) == 0) {  
                // if you don't get a result, then you're good
                $is_unique = true;
                $query = mysqli_query($koneksi, "INSERT INTO barang (ID_BARANG, NAMA_BARANG, ID_KATEGORI, STATUS_BARANG) VALUES ('".$random_id."', '".$nama."','".$kategori."','Aktif')");
            }
            else {
                $random_id = randString(10);
            }
        }
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data barang.";
            header("location: ../pengadaan/?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../pengadaan/?error");
        }
    } */

    if(isset($_POST['delete'])) {
        $id = $_POST['id_pengadaan'];
        //$query = mysqli_query($koneksi, "UPDATE pengadaan SET status_usulan = 'Dihapus' WHERE id_pengadaan = ".$id."");
        $query = mysqli_query($koneksi, "UPDATE pengadaan_aset SET STATUS_USULAN = 'Dihapus' WHERE ID_PENGADAAN = '".$id."'");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menghapus data.";
            header("location: ../pengadaan/?delete");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../pengadaan/?error");
        }
    }

    if(isset($_POST['add-item'])) {
        $nama = "";
        if(isset($_POST['barangusulan'])) {
            $nama = $_POST['barangusulan'];
        }
        if(isset($_POST['nama'])) {
            $nama = $_POST['nama'];
        }
        $barang = $_POST['barang'];
        echo $barang."<br >";
        /* $barang_backup = $_POST['barang_backup'];
        echo $barang_backup."<br >";
        if($barang_backup != $barang) {
            $barang = $barang_backup;
        } */
        
        $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE ID_BARANG = '".$barang."'");  
        $fet = mysqli_fetch_array($query);
        $nama_barang = $fet['NAMA_BARANG'];
        
        //$jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $rupiah = $_POST['rupiah'];
        $random_id = rand();
        $rand_bool = false;
        while($rand_bool = false) {
            if (in_array($random_id, $_SESSION['temp_item'])) {
                $random_id = rand();
            }
            else {
                $rand_bool = true;
            }
        }
        $add = array('temp_id' => $random_id, 'nama' => $nama, 'jenis' => $barang, 'harga' => $harga);
        $add_2 = array('temp_id' => $random_id, 'nama' => $nama, 'jenis' => $nama_barang, 'harga' => $rupiah);
        array_push($_SESSION['temp_item'], $add);
        array_push($_SESSION['temp_item_2'], $add_2);
        header("location: ../pengadaan/");
    }

    if(isset($_POST['hapus-item'])) {
        $val = $_POST['hapus-item'];
        //echo search_array($val);
        $key_index = array_search($val, array_column($_SESSION['temp_item'], 'nama'));
        $key_index_2 = array_search($val, array_column($_SESSION['temp_item_2'], 'nama'));
        array_splice($_SESSION['temp_item'], $key_index, 1);
        array_splice($_SESSION['temp_item_2'], $key_index_2, 1);
        //unset($_SESSION['temp_item'][$key_index]);
        //print_r($_SESSION['temp_item']);
        header("location: ../pengadaan/");
    }

    if(isset($_POST['simpan-usulan'])) {
        $keterangan = $_POST['keterangan'];
        $tanggal = date("Y-m-d H:i:s");
        if(empty($_SESSION['temp_item'])){
            $_SESSION['error-msg'] = "Tidak ada barang usulan";
            header("location: ../pengadaan/?error");
        }
        else {
            $success = true;
            $random_id = randomID('pengadaan_aset', 'ID_PENGADAAN', 10);
            ECHO "INSERT INTO pengadaan_aset (ID_PENGADAAN, ID_USER, KETERANGAN_USULAN, TANGGAL_USULAN, HASIL_APPROVAL, STATUS_USULAN) VALUES ('".$random_id."','".$_SESSION['id_user']."','".$keterangan."','".$tanggal."','Pending','Aktif') \n";
            $query = mysqli_query($koneksi, "INSERT INTO pengadaan_aset (ID_PENGADAAN, ID_USER, KETERANGAN_USULAN, TANGGAL_USULAN, HASIL_APPROVAL, STATUS_USULAN) VALUES ('".$random_id."','".$_SESSION['id_user']."','".$keterangan."','".$tanggal."','Pending','Aktif')");
            if(!$query) {
                $_SESSION['error-msg'] = mysqli_error($koneksi);
                echo $_SESSION['error-msg'];
                $success = false;
                header("location: ../pengadaan/?error");
            }
            
            $id_pengadaan = $random_id;
            foreach ($_SESSION['temp_item'] as $key => $value) {
                # code...
                $random_id_item = randomID('detil_usulan_pengadaan', 'ID_DETIL_TAMBAH', 6);
                echo "INSERT INTO detil_usulan_pengadaan (ID_USULAN_TAMBAH, ID_PENGADAAN, ID_BARANG, BARANG_USULAN, HARGA) VALUES ('".$random_id_item."','".$id_pengadaan."','".$value['jenis']."','".$value['nama']."','".$value['harga']."') <br>";
                $insert = mysqli_query($koneksi, "INSERT INTO detil_usulan_pengadaan (ID_USULAN_TAMBAH, ID_PENGADAAN, ID_BARANG, BARANG_USULAN, HARGA) VALUES ('".$random_id_item."','".$id_pengadaan."','".$value['jenis']."','".$value['nama']."','".$value['harga']."')");
                if(!$insert) {
                    $_SESSION['error-msg'] = mysqli_error($koneksi);
                    echo $_SESSION['error-msg'];
                    $success = false;
                    header("location: ../pengadaan/?error");
                    break;
                }
            }

            if($success) {
                $_SESSION['success-msg'] = "Sukses menambah data usulan.";
                $log = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG, ID_ACTIVITY, ACTIVITY_DETAIL) VALUES ('".$_SESSION['id_user']."','".$tanggal."', 'pengadaan', '".$id_pengadaan."','tambah_usulan')");
                /* $cek_data = mysqli_query($koneksi, "SELECT * FROM pengadaan_aset WHERE ID_USER = '".$_SESSION['id_user']."' AND HASIL_APPROVAL = 'Pending'");
                if(!isset($_SESSION['notifikasi-pengadaan'])){
                    $_SESSION['notifikasi-pengadaan'] = array();
                }
                while($baris = mysqli_fetch_array($cek_data)){
                    $add = array('id_pengadaan' => $baris['ID_PENGADAAN'], 'status' => $baris['HASIL_APPROVAL']);
                    array_push($_SESSION['notifikasi-pengadaan'], $add);
                } */
                //print_r($_SESSION['notifikasi-pengadaan']);
                unset($_SESSION['temp_item']);
                unset($_SESSION['temp_item_2']);
                $_SESSION['temp_item'] = array();
                $_SESSION['temp_item_2'] = array();
                header("location: ../pengadaan/?success");
            }
            else {
                $_SESSION['error-msg'] = mysqli_error($koneksi);
                header("location: ../pengadaan/?error");
            }
        }
    }

    if(isset($_POST['simpan-aset'])) {
        $now = date('Y-m-d H:i:s');
        $id_usulan_tambah = $_POST['id_usulan'];
        echo "id: ".$id_usulan_tambah."<br>";
        $nama_aset = $_POST['nama'];
        $kode_aset = $_POST['kode'];
        echo "kode aset: ".$kode_aset."<br>";
        $nomor = $_POST['nomor'];
        //$check_jml = $_POST['check_jml'];
        $nomor_aset = $_POST['nomor'];
        $jumlah_aset = 1;
        if(isset($_POST['jumlah'])) {
            $jumlah_aset = $_POST['jumlah'];
            echo "jumlah = ".$jumlah_aset."<br>";
        }
        $barang = $_POST['barang'];
        echo "barang: ".$barang."<br>";
        $merk = $_POST['merk'];
        echo "merk: ".$merk."<br>";
        $serimodel = $_POST['serimodel'];
        $komisi = $_POST['komisi'];
        echo "komisi: ".$komisi."<br>";
        $ruangan = $_POST['ruangan_aset'];
        echo "ruangan: ".$ruangan."<br>";
        $status = $_POST['status'];
        echo "status: ".$status."<br>";
        $harga = $_POST['harga_pembelian'];
        $masa_manfaat = 0;
        if(isset($_POST['masa_manfaat'])){
            $masa_manfaat = $_POST['masa_manfaat'];
        }
        $nilai = 0;
        if(isset($_POST['nilai_residu'])){
            $nilai = $_POST['nilai_residu'];
        }
        $new_tanggal = "";
        if(isset($_POST['tanggal_pengadaan'])){
            $tanggal = $_POST['tanggal_pengadaan'];
            $date = str_replace('/', '-', $tanggal);
            $new_tanggal = date("Y-m-d", strtotime($date));    
        }
        //echo $new_tanggal;
        $pinjam = 0;
        if(isset($_POST['pinjam'])) {
            $pinjam = 1;
        }
        echo "pinjam = ".$pinjam."<br>";
        if(isset($_FILES['foto']['name'])){
            $newfilename = $_FILES['foto']['name'];
            echo $newfilename;
            $target_dir = "../gambar/aset/";
            $target_file = $target_dir.basename($newfilename);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $check = mysqli_query($koneksi, "SELECT * FROM daftar_aset WHERE FOTO_ASET = '".$newfilename."'");
            if(mysqli_num_rows($check) > 0) {
                $newfilename = randString(10).".".$imageFileType;
                $target_file = $target_dir.basename($newfilename);
            }
            if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)){
                echo "uploaded to server, filename : ".$newfilename;
            }
        }
        if (isset($_POST['jumlah'])) {
            for($a = 0; $a < $jumlah_aset; $a++){
                $random_id = randomID('daftar_aset', 'ID_ASET', 10);
                $nomor_aset = formatNumber($a+1);
                $kode_aset_baru = $kode_aset.$nomor_aset;
                if(isset($_FILES['foto']['name'])){
                    echo "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, FOTO_ASET, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset_baru."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','".$newfilename."','Aktif') <br>";
                    $insert = mysqli_query($koneksi, "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, FOTO_ASET, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset_baru."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','".$newfilename."','Aktif')");
                }
                else{
                    $kode_aset_baru = $kode_aset.$nomor_aset;
                    echo "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset_baru."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif') <br>";
                    $insert = mysqli_query($koneksi, "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset_baru."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif')");
                }
            }
        }
        else {
            $random_id = randomID('daftar_aset', 'ID_ASET', 10);
            $kode_aset_baru = $kode_aset.$nomor_aset;
            if(isset($_FILES['foto']['name'])){
                echo "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, FOTO_ASET, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','".$newfilename."','Aktif') <br>";
                $insert = mysqli_query($koneksi, "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, FOTO_ASET, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','".$newfilename."','Aktif')");
            }
            else {
                echo "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif')";
                $insert = mysqli_query($koneksi, "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif')");
            }
        }
        
        if($insert) {
            $log = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG, ID_REF, ACTIVITY_DETAIL, ID_REF_DETAIL) VALUES ('".$_SESSION['id_user']."','".$now."', 'pengadaan', '".$_SESSION['pengadaan_aset']."','pengadaan_aset', '".$id_usulan_tambah."')");
            $_SESSION['success-msg'] = "Sukses menambah data aset.";
            header("location: add-asset.php?success&id=".$_SESSION['pengadaan_aset']."");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: add-asset.php?error&id=".$_SESSION['pengadaan_aset']."");
        }
    }
    if(isset($_POST['aset-jemaat'])) {
        $now = date('Y-m-d H:i:s');
        $id_usulan_tambah = $_POST['id_usulan'];
        echo "id: ".$id_usulan_tambah."<br>";
        $nama_aset = $_POST['nama'];
        $kode_aset = $_POST['kode'];
        echo "kode aset: ".$kode_aset."<br>";
        $nomor = $_POST['nomor'];
        //$check_jml = $_POST['check_jml'];
        $nomor_aset = $_POST['nomor'];
        $jumlah_aset = 1;
        if(isset($_POST['jumlah'])) {
            $jumlah_aset = $_POST['jumlah'];
            echo "jumlah = ".$jumlah_aset."<br>";
        }
        $barang = $_POST['barang'];
        echo "barang: ".$barang."<br>";
        $merk = $_POST['merk'];
        echo "merk: ".$merk."<br>";
        $serimodel = $_POST['serimodel'];
        $komisi = $_POST['komisi'];
        echo "komisi: ".$komisi."<br>";
        $ruangan = $_POST['ruangan_aset'];
        echo "ruangan: ".$ruangan."<br>";
        $status = $_POST['status'];
        echo "status: ".$status."<br>";
        $harga = 0;
        if(isset($_POST['harga_pembelian'])){
            $harga = $_POST['harga_pembelian'];
        }
        $masa_manfaat = 0;
        if(isset($_POST['masa_manfaat'])){
            $masa_manfaat = $_POST['masa_manfaat'];
        }
        $nilai = 0;
        if(isset($_POST['nilai_residu'])){
            $nilai = $_POST['nilai_residu'];
        }
        $new_tanggal = "";
        if(isset($_POST['tanggal_pengadaan'])){
            $tanggal = $_POST['tanggal_pengadaan'];
            $date = str_replace('/', '-', $tanggal);
            $new_tanggal = date("Y-m-d", strtotime($date));    
        }
        //echo $new_tanggal;
        $pinjam = 0;
        if(isset($_POST['pinjam'])) {
            $pinjam = 1;
        }
        echo "pinjam = ".$pinjam."<br>";
        if(isset($_FILES['foto']['name'])){
            $newfilename = $_FILES['foto']['name'];
            echo $newfilename;
            $target_dir = "../gambar/aset/";
            $target_file = $target_dir.basename($newfilename);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $check = mysqli_query($koneksi, "SELECT * FROM daftar_aset WHERE FOTO_ASET = '".$newfilename."'");
            if(mysqli_num_rows($check) > 0) {
                $newfilename = randString(10).".".$imageFileType;
                $target_file = $target_dir.basename($newfilename);
            }
            if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)){
                echo "uploaded to server, filename : ".$newfilename;
            }
        }
        if (isset($_POST['jumlah'])) {
            for($a = 0; $a < $jumlah_aset; $a++){
                $random_id = randomID('daftar_aset', 'ID_ASET', 10);
                $nomor_aset = formatNumber($a+1);
                $kode_aset_baru = $kode_aset.$nomor_aset;
                if(isset($_FILES['foto']['name'])){
                    echo "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, FOTO_ASET, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset_baru."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','".$newfilename."','Aktif') <br>";
                   $insert = mysqli_query($koneksi, "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, FOTO_ASET, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset_baru."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','".$newfilename."','Aktif')");
                }
                else{
                    echo "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset_baru."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif') <br>";
                    $insert = mysqli_query($koneksi, "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset_baru."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif')");
                }
            }
        }
        else {
            $kode_aset_baru = $kode_aset.$nomor_aset;
            $random_id = randomID('daftar_aset', 'ID_ASET', 10);
            if(isset($_FILES['foto']['name'])){
                echo "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, FOTO_ASET, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."',".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','".$newfilename."','Aktif') <br>";
                $insert = mysqli_query($koneksi, "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, FOTO_ASET, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','".$newfilename."','Aktif')");
            }
            else {
                echo "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif')";
                $insert = mysqli_query($koneksi, "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, SERI_MODEL, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$serimodel."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif')");
            }
        }
        
        if($insert) {
            $log = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG) VALUES ('".$_SESSION['id_user']."','".$now."', 'tambah_dari_jemaat')");
            $_SESSION['success-msg'] = "Sukses menambah data aset.";
            header("location: givewaway.php?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: givewaway.php?error");
        }
    }

?>
