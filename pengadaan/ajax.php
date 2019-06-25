<?php
    session_start();
    include "../connection.php";
    date_default_timezone_set("Asia/Jakarta");
    setlocale(LC_TIME, 'INDONESIA');
    setlocale(LC_NUMERIC, 'INDONESIA');
    
    
    if(isset($_POST['add_barang'])) {
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
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            echo $_SESSION['error-msg'];
        }
    }
    if(isset($_POST['add_merk'])) {
        $merk = $_POST['nama_merk'];
        $random_id = randString(6);
        $is_unique = false;
        while (!$is_unique) {
            $select = mysqli_query($koneksi, "SELECT * FROM merk WHERE ID_MERK = '".$random_id."'");
            if (mysqli_num_rows($select) == 0) {  
                // if you don't get a result, then you're good
                $is_unique = true;
                $query = mysqli_query($koneksi, "INSERT INTO merk (ID_MERK, NAMA_MERK, STATUS_MERK) VALUES ('".$random_id."', '".$merk."','Aktif')");
            }
            else {
                $random_id = randString(6);
            }
        }
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data merk.";
            echo $_SESSION['success-msg'];
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            echo $_SESSION['error-msg'];
        }
    }
    if(isset($_POST['add_ruangan'])) {
        $nama = $_POST['nama_ruangan'];
        $kategori = $_POST['kode_ruangan'];
        $random_id = randString(6);
        $is_unique = false;
        while (!$is_unique) {
            $select = mysqli_query($koneksi, "SELECT * FROM ruangan WHERE ID_RUANGAN = '".$random_id."'");
            if (mysqli_num_rows($select) == 0) {  
                // if you don't get a result, then you're good
                $is_unique = true;
                $query = mysqli_query($koneksi, "INSERT INTO ruangan (ID_RUANGAN, NAMA_RUANGAN, KODE_RUANGAN, STATUS_RUANGAN) VALUES ('".$random_id."', '".$nama."','".$kategori."','Aktif')");
            }
            else {
                $random_id = randString(6);
            }
        }
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data ruangan.";
            echo $_SESSION['success-msg'];
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            echo $_SESSION['error-msg'];
        }
    }
    if(isset($_POST['add_komisi'])) {
        $nama = $_POST['nama_komisi'];
        $kategori = $_POST['kode_komisi'];
        $random_id = randString(6);
        $is_unique = false;
        while (!$is_unique) {
            $select = mysqli_query($koneksi, "SELECT * FROM komisi_jemaat WHERE ID_KOMISI = '".$random_id."'");
            if (mysqli_num_rows($select) == 0) {  
                // if you don't get a result, then you're good
                $is_unique = true;
                $query = mysqli_query($koneksi, "INSERT INTO komisi_jemaat (ID_KOMISI, NAMA_KOMISI, KODE_KOMISI, STATUS_KOMISI) VALUES ('".$random_id."', '".$nama."','".$kategori."','Aktif')");
            }
            else {
                $random_id = randString(6);
            }
        }
        if($query) {
            $_SESSION['success-msg'] = "Sukses menambah data komisi jemaat.";
            echo $_SESSION['success-msg'];
        }
        else {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            echo $_SESSION['error-msg'];
        }
    }

    // kosongin item
    if(isset($_POST['empty'])){
        unset($_SESSION['temp_item']);
        unset($_SESSION['temp_item_2']);
        header("location:../pengadaan");
    }
    
    // approve pengadaan
    if (isset($_GET['approve'])) {
        $id = $_GET['approve'];
        $date = date('Y-m-d H:i:s');
        $query = mysqli_query($koneksi, "UPDATE pengadaan_aset SET HASIL_APPROVAL = 'Diterima', TANGGAL_APPROVE = '".$date."' WHERE ID_PENGADAAN = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
    }

    if (isset($_GET['reject'])) {
        $id = $_GET['reject'];
        $date = date('Y-m-d H:i:s');
        $query = mysqli_query($koneksi, "UPDATE pengadaan_aset SET HASIL_APPROVAL = 'Ditolak', TANGGAL_APPROVE = '".$date."' WHERE ID_PENGADAAN = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }    
    }
    if (isset($_POST['delete-usulan'])) {
        $id = $_POST['delete-usulan'];
        $query = mysqli_query($koneksi, "UPDATE pengadaan_aset SET STATUS_USULAN = 'Dihapus' WHERE ID_PENGADAAN = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
    }

    if (isset($_POST['usulan_detail'])) {
        $id = $_POST['usulan_detail'];
        $myObj = array();
        $a = 1;
        // $query = mysqli_query($koneksi, "SELECT p.barang_usulan, b.nama_barang, p.harga FROM pengadaan_barang p JOIN barang b ON p.id_barang = b.id_barang WHERE p.id_pengadaan = '".$id."'");
        $query = mysqli_query($koneksi, "SELECT p.barang_usulan, b.nama_barang, p.harga FROM detil_usulan_pengadaan p JOIN barang b ON p.id_barang = b.id_barang WHERE p.id_pengadaan = '".$id."'");
        while($row = mysqli_fetch_array($query)){
            $nama = $row['barang_usulan'];
            $barang = $row['nama_barang'];
            $harga = str_replace(',','.',asRupiah($row['harga']));
            //$array = array('nomor' => $a, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga);
            $array = array($a, $nama, $barang, $harga);
            array_push($myObj, $array);
            $a++;
        }
        //$myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga, 'keterangan' => $keterangan);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }
    
    if(isset($_POST['id-insert'])) {
        $id = $_POST['id-insert'];
        //$query = mysqli_query($koneksi, "SELECT p.barang_usulan, p.id_barang, b.nama_barang, p.harga FROM pengadaan_barang p JOIN barang b ON p.id_barang = b.id_barang WHERE p.id_temp = '".$id."'");
        $query = mysqli_query($koneksi, "SELECT p.barang_usulan, p.id_barang, b.nama_barang, p.harga FROM detil_usulan_pengadaan p JOIN barang b ON p.id_barang = b.id_barang WHERE p.id_usulan_tambah = '".$id."'");
        $row = mysqli_fetch_array($query);
        $nama = $row['barang_usulan'];
        $barang = $row['id_barang'];
        $harga = $row['harga'];
        $myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

?>