<?php
    session_start();
    setlocale (LC_TIME, 'INDONESIAN');
    date_default_timezone_set("Asia/Jakarta");
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
        $merk = $_POST['merk'];
        $serimodel = $_POST['serimodel'];
        $query = mysqli_query($koneksi, "INSERT INTO barang (nama_barang, id_kategori, merk, seri_model, status_barang) VALUES ('".$nama."',".$kategori.",'".$merk."','".$serimodel."','Aktif')");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data barang.";
            header("location: ../pengadaan/?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../pengadaan/?error");
        }
    }

    if(isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $kategori = $_POST['barang'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $keterangan = $_POST['keterangan'];
        $tanggal = date("Y-m-d H:i:s");
        
        $query = mysqli_query($koneksi, "INSERT INTO pengadaan (barang_usulan, id_barang, jumlah, harga, keterangan_usulan, tanggal_usulan, status_usulan) VALUES ('".$nama."',".$barang.",".$jumlah.",".$harga.",'".$keterangan."','".$tanggal."','Pending')");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data usulan.";
            header("location: ../pengadaan/?success");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../pengadaan/?error");
        }
    }

    if(isset($_POST['edit'])) {
        $id = $_POST['id_pengadaan'];
        $nama = $_POST['nama'];
        $kategori = $_POST['barang'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $keterangan = $_POST['keterangan'];
        $tanggal = date("Y-m-d H:i:s");
        $query = mysqli_query($koneksi, "UPDATE pengadaan SET barang_usulan = '".$nama."', id_barang = ".$barang.", jumlah = ".$jumlah.", harga = ".$harga.", keterangan = '".$keterangan."', tanggal_modifikasi = '".$tanggal."' WHERE id_pengadaan = ".$id."");
        if($query) {
            $_SESSION['success-msg'] = "Sukses mengubah data.";
            header("location: ../pengadaan/?edit");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../pengadaan/?error");
        }
    }

    if(isset($_POST['delete'])) {
        $id = $_POST['id_pengadaan'];
        $query = mysqli_query($koneksi, "UPDATE pengadaan SET status_usulan = 'Dihapus' WHERE id_pengadaan = ".$id."");
        if($query) {
            $_SESSION['success-msg'] = "Sukses menghapus data.";
            header("location: ../pengadaan/?delete");
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            header("location: ../pengadaan/?error");
        }
    }
?>