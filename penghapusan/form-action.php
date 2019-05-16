<?php
    session_start();
    setlocale (LC_TIME, 'INDONESIAN');
    date_default_timezone_set("Asia/Jakarta");
    include "../connection.php";

    if(isset($_POST['simpan-usulan'])) {
        $keterangan = $_POST['keterangan'];
        $tanggal = date("Y-m-d H:i:s");
        if(empty($_SESSION['temp_hapus'])){
            $_SESSION['error-msg'] = "Tidak ada barang usulan";
            header("location: ../penghapusan/?error");
        }
        else {
            $id_pengadaan = randomID('detil_usulan_penghapusan', 'ID_USULAN_HAPUS', 10);
            echo $id_pengadaan."\n";
            ECHO "INSERT INTO penghapusan_aset (ID_PENGHAPUSAN, KETERANGAN_PENGHAPUSAN, TANGGAL_USULAN, HASIL_APPROVAL, STATUS_USULAN) VALUES ('".$id_pengadaan."','".$keterangan."','".$tanggal."','Pending','Aktif') \n";
            $query = mysqli_query($koneksi, "INSERT INTO penghapusan_aset (ID_PENGHAPUSAN, KETERANGAN_PENGHAPUSAN, TANGGAL_USULAN, HASIL_APPROVAL, STATUS_USULAN) VALUES ('".$id_pengadaan."','".$keterangan."','".$tanggal."','Pending','Aktif')");

            foreach ($_SESSION['temp_hapus'] as $key => $value) {
                # code...
                $id_detil_hapus = randomID('detil_usulan_hapus', 'ID_USULAN_HAPUS', 10);
                echo "INSERT INTO detil_usulan_penghapusan (ID_USULAN_HAPUS, ID_PENGHAPUSAN, ID_ASET) VALUES ('".$id_detil_hapus."','".$id_pengadaan."','".$value['id_aset']."') \n";
                $insert = mysqli_query($koneksi, "INSERT INTO detil_usulan_penghapusan (ID_USULAN_HAPUS, ID_PENGHAPUSAN, ID_ASET) VALUES ('".$id_detil_hapus."','".$id_pengadaan."','".$value['id_aset']."')");
                }

            if($query && $insert) {
                $_SESSION['success-msg'] = "Sukses menambah data usulan.";
                unset($_SESSION['temp_hapus']);
                $_SESSION['temp_hapus'] = array();
                header("location: ../penghapusan/?success");
            }
            else {
                $_SESSION['error-msg'] = mysqli_error($koneksi);
                header("location: ../penghapusan/?error");
            }
        }
    }


    if(isset($_POST['simpan-aset'])) {
        $id_usulan_tambah = $_POST['id_usulan'];
        echo "id: ".$id_usulan_tambah."<br>";
        $nama_aset = $_POST['nama'];
        $kode_aset = $_POST['kode'];
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
        if(isset($_POST['tanggal_penghapusan'])){
            $tanggal = $_POST['tanggal_penghapusan'];
            $date = str_replace('/', '-', $tanggal);
            $new_tanggal = date("Y-m-d", strtotime($date));    
        }
        //echo $new_tanggal;
        $pinjam = 0;
        if(isset($_POST['pinjam'])) {
            $pinjam = 1;
        }
        echo "pinjam = ".$pinjam."<br>";
        
        if (isset($_POST['jumlah'])) {
            for($a = 0; $a < $jumlah_aset; $a++){
                $random_id = randString(10);
                $is_unique = false;
                    
                while (!$is_unique) {
                    $select = mysqli_query($koneksi, "SELECT * FROM daftar_aset WHERE ID_ASET = '".$random_id."'");
                    if (mysqli_num_rows($select) == 0) {  
                        // if you don't get a result, then you're good
                        $is_unique = true;
                        //$query = mysqli_query($koneksi, "INSERT INTO barang (ID_BARANG, NAMA_BARANG, ID_KATEGORI, STATUS_BARANG) VALUES ('".$random_id."', '".$nama."','".$kategori."','Aktif')");
                    }
                    else {
                        $random_id = randString(10);
                    }
                }
                echo "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif') <br>";
                $insert = mysqli_query($koneksi, "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif')");
            }
        }
        else {
            $random_id = randString(10);
            $is_unique = false;
            while (!$is_unique) {
                $select = mysqli_query($koneksi, "SELECT * FROM daftar_aset WHERE ID_ASET = '".$random_id."'");
                if (mysqli_num_rows($select) == 0) {  
                    // if you don't get a result, then you're good
                    $is_unique = true;
                    //$query = mysqli_query($koneksi, "INSERT INTO barang (ID_BARANG, NAMA_BARANG, ID_KATEGORI, STATUS_BARANG) VALUES ('".$random_id."', '".$nama."','".$kategori."','Aktif')");
                }
                else {
                    $random_id = randString(10);
                }
            }
            echo "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif')";
            $insert = mysqli_query($koneksi, "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$harga."','".$new_tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif')");
        }
        
        if($insert) {
            $_SESSION['success-msg'] = "Sukses menambah data aset.";
            header("location: add-asset.php?success&id=".$_SESSION['penghapusan_aset']."");
            //header("location: ../penghapusan/approval?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: add-asset.php?error&id=".$_SESSION['penghapusan_aset']."");
        }
    }

?>