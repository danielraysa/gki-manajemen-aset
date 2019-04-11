<?php
    session_start();
    setlocale (LC_TIME, 'INDONESIAN');
    date_default_timezone_set("Asia/Jakarta");
    include "../connection.php";

    if(isset($_POST['add-barang'])) {
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
    }

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
        $nama = $_POST['nama'];
        $barang = $_POST['barang'];
        //$nama_barang = $_POST['nama_barang'];
        //if($nama_barang == "") {
        $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE ID_BARANG = '".$barang."'");  
        $fet = mysqli_fetch_array($query);
        $nama_barang = $fet['NAMA_BARANG'];
        //}
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
            $random_id = randString(10);
            $is_unique = false;
                
            while (!$is_unique) {
                $select = mysqli_query($koneksi, "SELECT * FROM pengadaan_aset WHERE ID_PENGADAAN = '".$random_id."'");
                if (mysqli_num_rows($select) == 0) {  
                    // if you don't get a result, then you're good
                    $is_unique = true;
                    ECHO "INSERT INTO pengadaan_aset (ID_PENGADAAN, KETERANGAN_USULAN, TANGGAL_USULAN, HASIL_APPROVAL, STATUS_USULAN) VALUES ('".$random_id."','".$keterangan."','".$tanggal."','Pending','Aktif') <br>";
                    $query = mysqli_query($koneksi, "INSERT INTO pengadaan_aset (ID_PENGADAAN, KETERANGAN_USULAN, TANGGAL_USULAN, HASIL_APPROVAL, STATUS_USULAN) VALUES ('".$random_id."','".$keterangan."','".$tanggal."','Pending','Aktif')");
                    if(!$query) {
                        $_SESSION['error-msg'] = mysqli_error($koneksi);
                        echo $_SESSION['error-msg'];
                        header("location: ../pengadaan/?error");
                        //$success = false;
                        break;
                    }
                }
                else {
                    $random_id = randString(10);
                }
            }
            //$select = mysqli_query($koneksi, "SELECT * FROM pengadaan_aset WHERE KETERANGAN_USULAN = '".$keterangan."' AND TANGGAL_USULAN = '".$tanggal."'");
            //$fetch = mysqli_fetch_array($select);
            //$id_pengadaan = $fetch['ID_PENGADAAN'];
            $id_pengadaan = $random_id;
            $success = true;
            foreach ($_SESSION['temp_item'] as $key => $value) {
                # code...
                $random_id_item = randString(6);
                $is_unique_new = false;
                while (!$is_unique_new) {
                    $select = mysqli_query($koneksi, "SELECT * FROM detil_usulan_pengadaan WHERE ID_USULAN_TAMBAH = '".$random_id_item."'");
                    if (mysqli_num_rows($select) == 0) {  
                        // if you don't get a result, then you're good
                        $is_unique_new = true;
                        echo "INSERT INTO detil_usulan_pengadaan (ID_USULAN_TAMBAH, ID_PENGADAAN, ID_BARANG, BARANG_USULAN, HARGA) VALUES ('".$random_id_item."','".$id_pengadaan."','".$value['jenis']."','".$value['nama']."','".$value['harga']."') <br>";
                        $insert = mysqli_query($koneksi, "INSERT INTO detil_usulan_pengadaan (ID_USULAN_TAMBAH, ID_PENGADAAN, ID_BARANG, BARANG_USULAN, HARGA) VALUES ('".$random_id_item."','".$id_pengadaan."','".$value['jenis']."','".$value['nama']."','".$value['harga']."')");
                        if(!$insert) {
                            $_SESSION['error-msg'] = mysqli_error($koneksi);
                            echo $_SESSION['error-msg'];
                            header("location: ../pengadaan/?error");
                            $success = false;
                            break;
                        }
                    }
                    else {
                        $random_id_item = randString(6);
                    }
                }
                //$insert = mysqli_query($koneksi, "INSERT INTO pengadaan_barang (id_pengadaan, id_barang, barang_usulan, harga) VALUES ('".$id_pengadaan."','".$value['jenis']."','".$value['nama']."','".$value['harga']."')");
                //$insert = mysqli_query($koneksi, "INSERT INTO detil_usulan_pengadaan (ID_PENGADAAN, ID_BARANG, BARANG_USULAN, HARGA) VALUES ('".$id_pengadaan."','".$value['jenis']."','".$value['nama']."','".$value['harga']."')");
            }

            if($success) {
                $_SESSION['success-msg'] = "Sukses menambah data usulan.";
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
        $masa_manfaat = $_POST['masa_manfaat'];
        $nilai = $_POST['nilai_residu'];
        $tanggal = $_POST['tanggal_pengadaan'];
        $date = str_replace('/', '-', $tanggal);
        $new_tanggal = date("Y-m-d", strtotime($date));
        //echo $new_tanggal;
        $pinjam = 0;
        if(isset($_POST['check_jml'])) {
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
                $insert = mysqli_query($koneksi, "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$harga."','".$tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif')");
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
            $insert = mysqli_query($koneksi, "INSERT INTO daftar_aset (ID_ASET, ID_MERK, ID_RUANGAN, ID_USULAN_TAMBAH, ID_KOMISI, ID_STATUS, NAMA_ASET, KODE_ASET, HARGA_PEMBELIAN, TANGGAL_PEMBELIAN, MASA_MANFAAT, NILAI_RESIDU, PERBOLEHAN_PINJAM, STATUS_ASET) VALUES ('".$random_id."','".$merk."','".$ruangan."','".$id_usulan_tambah."','".$komisi."','".$status."','".$nama_aset."','".$kode_aset."','".$harga."','".$tanggal."','".$masa_manfaat."','".$nilai."','".$pinjam."','Aktif')");
        }
        
        if($insert) {
            $_SESSION['success-msg'] = "Sukses menambah data aset.";
            header("location: add-asset.php?id=".$_SESSION['pengadaan_aset']."");
            //header("location: ../pengadaan/approval?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../pengadaan/add-asset.php?error&id=".$_SESSION['pengadaan_aset']."");
        }
    }

?>