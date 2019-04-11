<?php
    session_start();
    include "../connection.php";

    setlocale(LC_NUMERIC, 'INDONESIA');
    function asRupiah($value) {
        return 'Rp. ' . number_format($value);
    }
    
    /* if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM pengadaan WHERE id_pengadaan = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['id_pengadaan'];
        $nama = $row['barang_usulan'];
        $barang = $row['id_barang'];
        //$jumlah = $row['jumlah'];
        $harga = $row['harga'];
        $keterangan = $row['keterangan_usulan'];

        //$myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'jumlah' => $jumlah, 'harga' => $harga, 'keterangan' => $keterangan);
        $myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga, 'keterangan' => $keterangan);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    } */

    /* if(isset($_POST['add'])) {
        //$id = "datanew";
        $nama = $_POST['nama'];
        $id_barang = $_POST['barang'];
        $nama_barang = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        //$jumlah = $_POST['jumlah'];
        //$keterangan = $_POST['keterangan'];
        $add = array('nama' => $nama, 'jenis' => $nama_barang, 'harga' => $harga);
        $add_2 = array($nama, $nama_barang, "<div id='txt_harga'>".$harga."</div>", "<button class='btn btn-danger' data-delete='".$nama."'><i class='fa fa-trash'></i> Delete</button>");

        array_push($_SESSION['temp_item'], $add);
        array_push($_SESSION['temp_item_2'], $add_2);
        //$myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga, 'keterangan' => $keterangan);
        //$myJSON = json_encode($add);
        $myJSON = json_encode($_SESSION['temp_item_2']);
        echo $myJSON;
    } */

    if(isset($_POST['empty'])){
        unset($_SESSION['temp_item']);
        unset($_SESSION['temp_item_2']);
        header("location:../pengadaan");
    }

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