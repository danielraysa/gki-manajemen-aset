<?php
    session_start();
    
    include "../connection.php";

    function formatNumber($nbr){
        if ($nbr < 10) {
            return "000".$nbr;
        }
        elseif ($nbr >= 10 && $nbr < 100 ){
            return "00".$nbr;
        }
        elseif ($nbr >= 100 && $nbr < 1000 ){
            return "0".$nbr;
        }
        else{
            return strval($nbr);
        }
    }

    function addAsset() {
        global $koneksi;
        $id_usulan_tambah = null;
        if(isset($_POST['id_usulan'])){
            $id_usulan_tambah = $_POST['id_usulan'];
        }
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
        $barang = $_POST['barang']; // kode jenis
        echo "barang: ".$barang."<br>";
        /* $get_barang = mysqli_query($koneksi, "SELECT * FROM kategori WHERE KODE_KATEGORI = '".$barang."'");
        $fet_jenis = mysqli_fetch_array($get_barang);
        $jenis = $fet_jenis['NAMA_KATEGORI']; */
        $merk = $_POST['merk'];
        echo "merk: ".$merk."<br>";
        $serimodel = $_POST['serimodel']; // type
        $komisi = $_POST['komisi'];
        echo "komisi: ".$komisi."<br>";
        /* $get_komisi = mysqli_query($koneksi, "SELECT * FROM komisi_jemaat WHERE KODE_KOMISI = '".$komisi."'");
        $fet_komisi = mysqli_fetch_array($get_komisi);
        $nama_komisi = $fet_jenis['NAMA_KOMISI']; */
        $lokasi = $_POST['lokasi_aset'];
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
        $new_tanggal = null;
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
        $status = 'Aktif';
        if(isset($_POST['status'])){
            $status = $_POST['status'];
        }
        echo "pinjam = ".$pinjam."<br>";
        // tambahan
        // $keterangan_lokasi = $_POST['keterangan_lokasi'];
        $keterangan = $_POST['keterangan_aset'];
        
        $newfilename = null;
        
        if(isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != null){
            $newfilename = $_FILES['foto']['name'];
            echo $newfilename;
            $target_dir = "../gambar/aset/";
            $target_file = $target_dir.basename($newfilename);
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // $check = mysqli_query($koneksi, "SELECT * FROM daftar_aset WHERE FOTO_ASET = '".$newfilename."'");
            $check = mysqli_query($koneksi, "SELECT * FROM daftar_baru WHERE FOTO_ASET = '".$newfilename."'");
            if(mysqli_num_rows($check) > 0) {
                $newfilename = randString(10).".".$imageFileType;
                $target_file = $target_dir.basename($newfilename);
            }
            if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)){
                echo "uploaded to server, filename : ".$newfilename;
            }
        }
        $_SESSION['kode_print_barcode'] = array();
        if (isset($_POST['jumlah'])) {
            for($a = 0; $a < $jumlah_aset; $a++){
                // $random_id = randomID('daftar_aset', 'ID_ASET', 10);
                $nomor_aset = formatNumber($a+1);
                $kode_aset_baru = $kode_aset.$nomor_aset;

                $query_insert = "INSERT INTO daftar_baru (ID_MERK, LOKASI_BARANG, RUANGAN_BARANG, ID_USULAN_TAMBAH, NAMA_BARANG, KODE_BARANG, JENIS_BARANG, SERI_MODEL, KETERANGAN, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, FOTO_ASET, STATUS_ASET) VALUES ('".$merk."','".$lokasi."','".$ruangan."','".$id_usulan_tambah."','".$nama_aset."','".$kode_aset_baru."','".$barang."','".$serimodel."','".$keterangan."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','".$newfilename."','".$status."')";
                // echo $query_insert."<br>";
                $insert = mysqli_query($koneksi, $query_insert);
                array_push($_SESSION['kode_print_barcode'], $kode_aset_baru);
            }
        }
        else {
            // $random_id = randomID('daftar_aset', 'ID_ASET', 10);
            // $kode_aset_baru = $kode_aset.$nomor_aset;
            $query_insert = "INSERT INTO daftar_baru (ID_MERK, LOKASI_BARANG, RUANGAN_BARANG, ID_USULAN_TAMBAH, NAMA_BARANG, KODE_BARANG, JENIS_BARANG, SERI_MODEL, KETERANGAN, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, FOTO_ASET, STATUS_ASET) VALUES ('".$merk."','".$lokasi."','".$ruangan."','".$id_usulan_tambah."','".$nama_aset."','".$kode_aset."','".$barang."','".$serimodel."','".$keterangan."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','".$newfilename."','".$status."')";
            $insert = mysqli_query($koneksi, $query_insert);
            array_push($_SESSION['kode_print_barcode'], $kode_aset);
        }
        return $insert;
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
        /* $barang = $_POST['barang'];
        echo $barang."<br >"; */
        /* $barang_backup = $_POST['barang_backup'];
        echo $barang_backup."<br >";
        if($barang_backup != $barang) {
            $barang = $barang_backup;
        } */
        
        /* $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE ID_BARANG = '".$barang."'");  
        $fet = mysqli_fetch_array($query);
        $nama_barang = $fet['NAMA_BARANG']; */
        
        //$jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $rupiah = $_POST['rupiah'];
        $keterangan = $_POST['ket_barang'];
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
        $add = array('temp_id' => $random_id, 'nama' => $nama, 'harga' => $harga, 'harga_rp' => $rupiah, 'keterangan' => $keterangan);
        // $add_2 = array('temp_id' => $random_id, 'nama' => $nama, 'jenis' => $nama_barang, 'harga' => $rupiah);
        array_push($_SESSION['temp_item'], $add);
        // array_push($_SESSION['temp_item_2'], $add_2);
        header("location: ../pengadaan/");
    }

    if(isset($_POST['hapus-item'])) {
        $val = $_POST['hapus-item'];
        //echo search_array($val);
        $key_index = array_search($val, array_column($_SESSION['temp_item'], 'nama'));
        // $key_index_2 = array_search($val, array_column($_SESSION['temp_item_2'], 'nama'));
        array_splice($_SESSION['temp_item'], $key_index, 1);
        // array_splice($_SESSION['temp_item_2'], $key_index_2, 1);
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
            // ECHO "INSERT INTO pengadaan_aset (ID_PENGADAAN, ID_USER, KETERANGAN_USULAN, TANGGAL_USULAN, HASIL_APPROVAL, STATUS_USULAN) VALUES ('".$random_id."','".$_SESSION['id_user']."','".$keterangan."','".$tanggal."','Pending','Aktif') \n";
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
                // echo "INSERT INTO detil_usulan_pengadaan (ID_USULAN_TAMBAH, ID_PENGADAAN, ID_BARANG, BARANG_USULAN, HARGA) VALUES ('".$random_id_item."','".$id_pengadaan."','".$value['jenis']."','".$value['nama']."','".$value['harga']."') <br>";
                $insert = mysqli_query($koneksi, "INSERT INTO detil_usulan_pengadaan (ID_USULAN_TAMBAH, ID_PENGADAAN, BARANG_USULAN, HARGA, KETERANGAN) VALUES ('".$random_id_item."','".$id_pengadaan."','".$value['nama']."','".$value['harga']."','".$value['keterangan']."')");
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
        $insert = addAsset();
        $now = date('Y-m-d H:i:s');
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

    if(isset($_POST['aset-manual'])) {
        $insert = addAsset();
        $now = date('Y-m-d H:i:s');
        if($insert) {
            $log = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG) VALUES ('".$_SESSION['id_user']."','".$now."', 'tambah_manual')");
            $_SESSION['success-msg'] = "Sukses menambah data aset.";
            header("location: add-manual.php?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: add-manual.php?error");
        }
    }

?>
