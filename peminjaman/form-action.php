<?php
    session_start();
    
    include "../connection.php";
    
    if (isset($_POST['scan'])) {
        $id = $_POST['id_barcode'];
        $qty = 1;
		$db_handle = new DBController();
        $productByCode = $db_handle->runQuery("SELECT * FROM sarpras WHERE id = '".$id."'");
        $itemArray = array($productByCode[0]["id"]=>array('id'=>$productByCode[0]["id"], 'nama'=>$productByCode[0]["nama"], 'jenis'=>$productByCode[0]["jenis"], 'qty'=>$qty));
        
        if(!empty($_SESSION["cart_item"])) {
            if(in_array($productByCode[0]["id"],array_keys($_SESSION["cart_item"]))) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                        if($productByCode[0]["id"] == $k) {
                            if(empty($_SESSION["cart_item"][$k]["qty"])) {
                                $_SESSION["cart_item"][$k]["qty"] = 0;
                            }
                            $_SESSION["cart_item"][$k]["qty"] += $qty;
                        }
                }
            } else {
                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
            }
        } else {
            $_SESSION["cart_item"] = $itemArray;
        }
    }
    if (isset($_POST['empty'])) {
        unset($_SESSION["cart_item"]);
        
    }
    if(isset($_POST['add-barang'])) {
        $nama = $_POST['nama'];
        $kategori = $_POST['kategori'];
        //$merk = $_POST['merk'];
        //$serimodel = $_POST['serimodel'];
        // $query = mysqli_query($koneksi, "INSERT INTO barang (nama_barang, id_kategori, merk, seri_model, status_barang) VALUES ('".$nama."',".$kategori.",'".$merk."','".$serimodel."','Aktif')");
        $query = mysqli_query($koneksi, "INSERT INTO barang (NAMA_BARANG, ID_KATEGORI) VALUES ('".$nama."',".$kategori.",'Aktif')");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data barang.";
            header("location: ../pengadaan/?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../pengadaan/?error");
        }
    }

    if(isset($_POST['simpan-pinjam'])) {
        $keterangan = $_POST['keterangan'];
        $tanggal = date("Y-m-d H:i:s");
        $nomor = $_POST['nohp'];
        $tanggal = $_POST['tgl_pinjam'];
        //echo $tanggal;
        $tgl_awal = substr($tanggal,13);
        //echo $tgl_awal;
        $date = str_replace('/', '-', $tgl_awal);
        echo $date;
        $tgl_pinjam = date("Y-m-d", strtotime($date));
        echo $tgl_pinjam;
        /* if(empty($_SESSION['temp_item'])){
            $_SESSION['error-msg'] = "Tidak ada barang usulan";
            header("location: ../pengadaan/?error");
        }
        else {
            $random_id = randString(10);
            $is_unique = false;
                
            while (!$is_unique) {
                $select = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE ID_PEMINJAMAN = '".$random_id."'");
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
        } */
    }
?>