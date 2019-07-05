<?php

session_start();
include "connection.php";

if(isset($_POST['ruangan'])) {
    $query = mysqli_query($koneksi, "SELECT d.ID_RUANGAN as id_ruangan, r.NAMA_RUANGAN as ruangan, COUNT(d.ID_RUANGAN) as jumlah FROM daftar_aset d JOIN ruangan r ON d.ID_RUANGAN = r.ID_RUANGAN GROUP BY d.ID_RUANGAN");
    $data = array();
    while($result = mysqli_fetch_array($query)){
        $inc = array('id' => $result['id_ruangan'], 'ruangan' => $result['ruangan'], 'jumlah' => $result['jumlah']);
        array_push($data, $inc);
    }
    $json = json_encode($data);
    echo $json;
}
if(isset($_POST['item_ruangan'])) {
    $id = $_POST['item_ruangan'];
    $query = mysqli_query($koneksi, "SELECT d.KODE_ASET, d.NAMA_ASET, b.NAMA_BARANG FROM daftar_aset d JOIN detil_usulan_pengadaan dp ON d.ID_USULAN_TAMBAH = dp.ID_USULAN_TAMBAH JOIN barang b ON dp.ID_BARANG = b.ID_BARANG JOIN ruangan r ON d.ID_RUANGAN = r.ID_RUANGAN WHERE d.ID_RUANGAN = '".$id."'");
    $data = array();
    $a = 1;
    while($result = mysqli_fetch_array($query)){
        $inc = array($a, $result['KODE_ASET'], $result['NAMA_ASET'], $result['NAMA_BARANG']);
        array_push($data, $inc);
        $a++;
    }
    $json = json_encode($data);
    echo $json;
}

if(isset($_POST['komisi'])) {
    $query = mysqli_query($koneksi, "SELECT d.ID_KOMISI as id_komisi, r.NAMA_KOMISI as komisi, COUNT(d.ID_KOMISI) as jumlah FROM daftar_aset d JOIN komisi_jemaat r ON d.ID_KOMISI = r.ID_KOMISI GROUP BY d.ID_KOMISI");
    $data = array();
    while($result = mysqli_fetch_array($query)){
        $inc = array('id' => $result['id_komisi'], 'komisi' => $result['komisi'], 'jumlah' => $result['jumlah']);
        array_push($data, $inc);
    }

    $json = json_encode($data);
    echo $json;
}
if(isset($_POST['item_komisi'])) {
    $id = $_POST['item_komisi'];
    $query = mysqli_query($koneksi, "SELECT d.KODE_ASET, d.NAMA_ASET, b.NAMA_BARANG FROM daftar_aset d JOIN detil_usulan_pengadaan dp ON d.ID_USULAN_TAMBAH = dp.ID_USULAN_TAMBAH JOIN barang b ON dp.ID_BARANG = b.ID_BARANG JOIN komisi_jemaat k ON d.ID_KOMISI = k.ID_KOMISI WHERE d.ID_KOMISI = '".$id."'");
    $data = array();
    $a = 1;
    while($result = mysqli_fetch_array($query)){
        $inc = array($a, $result['KODE_ASET'], $result['NAMA_ASET'], $result['NAMA_BARANG']);
        array_push($data, $inc);
        $a++;
    }
    $json = json_encode($data);
    echo $json;
}

if (isset($_POST['pinjam_detail'])) {
    $id = $_POST['pinjam_detail'];
    $myObj = array();
    $a = 1;
    $query = mysqli_query($koneksi, "SELECT p.id_detil_pinjam, a.nama_aset, b.nama_barang FROM detail_peminjaman p JOIN daftar_aset a ON p.id_aset = a.id_aset JOIN detil_usulan_pengadaan pd ON a.id_usulan_tambah = pd.id_usulan_tambah JOIN barang b ON pd.id_barang = b.id_barang WHERE p.id_peminjaman = '".$id."'");
    while($row = mysqli_fetch_array($query)){
        $nama = $row['nama_aset'];
        $barang = $row['nama_barang'];
        $id_item = $row['id_detil_pinjam'];
        
        $array = array($a, $nama, $barang);
        array_push($myObj, $array);
        $a++;
    }
    //$myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga, 'keterangan' => $keterangan);
    $myJSON = json_encode($myObj);
    echo $myJSON;
}

?>