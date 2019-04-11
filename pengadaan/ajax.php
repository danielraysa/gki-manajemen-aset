<?php
    session_start();
    include "../connection.php";

    setlocale(LC_NUMERIC, 'INDONESIA');
    function asRupiah($value) {
        return 'Rp. ' . number_format($value);
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
        $query = mysqli_query($koneksi, "UPDATE pengadaan_aset SET HASIL_APPROVAL = 'Diterima' WHERE ID_PENGADAAN = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
    }

    if (isset($_GET['reject'])) {
        $id = $_GET['reject'];
        $query = mysqli_query($koneksi, "UPDATE pengadaan_aset SET HASIL_APPROVAL = 'Ditolak' WHERE ID_PENGADAAN = '".$id."'");
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