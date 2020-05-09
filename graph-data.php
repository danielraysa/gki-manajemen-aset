<?php
session_start();
include "connection.php";

if(isset($_POST['ruangan'])) {
    // $query = mysqli_query($koneksi, "SELECT d.ID_RUANGAN as id_ruangan, r.NAMA_RUANGAN as ruangan, COUNT(d.ID_RUANGAN) as jumlah FROM daftar_aset d JOIN ruangan r ON d.ID_RUANGAN = r.ID_RUANGAN GROUP BY d.ID_RUANGAN");
    $query = mysqli_query($koneksi, "SELECT LOKASI_BARANG, count(*) JUMLAH FROM daftar_baru WHERE LOKASI_BARANG IS NOT NULL GROUP BY LOKASI_BARANG");
    $data = array();
    while($result = mysqli_fetch_array($query)){
        // $inc = array('id' => $result['id_ruangan'], 'ruangan' => $result['ruangan'], 'jumlah' => $result['jumlah']);
        $inc = array('id' => $result['LOKASI_BARANG'], 'ruangan' => $result['LOKASI_BARANG'], 'jumlah' => $result['JUMLAH']);
        array_push($data, $inc);
    }
    $json = json_encode($data);
    echo $json;
}
if(isset($_POST['item_ruangan'])) {
    $id = $_POST['item_ruangan'];
    // $query = mysqli_query($koneksi, "SELECT d.KODE_ASET, d.NAMA_ASET, b.NAMA_BARANG FROM daftar_aset d JOIN detil_usulan_pengadaan dp ON d.ID_USULAN_TAMBAH = dp.ID_USULAN_TAMBAH JOIN barang b ON dp.ID_BARANG = b.ID_BARANG JOIN ruangan r ON d.ID_RUANGAN = r.ID_RUANGAN WHERE d.ID_RUANGAN = '".$id."'");
    $query = mysqli_query($koneksi, "SELECT KODE_BARANG, NAMA_BARANG, JENIS, NAMA_KATEGORI FROM daftar_baru JOIN kategori ON daftar_baru.KODE_JENIS = kategori.KODE_KATEGORI WHERE LOKASI_BARANG = '".$id."'");
    if($query){
    $data = array();
    $a = 1;
    while($result = mysqli_fetch_array($query)){
        $inc = array($a, $result['KODE_BARANG'], $result['NAMA_BARANG'], $result['NAMA_KATEGORI']);
        array_push($data, $inc);
        $a++;
    }
    $json = json_encode($data);
    echo $json;
    }else{
        echo mysqli_error($koneksi);
    }
}

if(isset($_POST['komisi'])) {
    // $query = mysqli_query($koneksi, "SELECT d.ID_KOMISI as id_komisi, r.NAMA_KOMISI as komisi, COUNT(d.ID_KOMISI) as jumlah FROM daftar_aset d JOIN komisi_jemaat r ON d.ID_KOMISI = r.ID_KOMISI GROUP BY d.ID_KOMISI");
    $query = mysqli_query($koneksi, "SELECT KODE_KOMISI, KOMISI, count(*) JUMLAH FROM daftar_baru GROUP BY KODE_KOMISI, KOMISI");
    $data = array();
    while($result = mysqli_fetch_array($query)){
        $inc = array('id' => $result['KODE_KOMISI'], 'komisi' => $result['KOMISI'], 'jumlah' => $result['JUMLAH']);
        array_push($data, $inc);
    }

    $json = json_encode($data);
    echo $json;
}
if(isset($_POST['item_komisi'])) {
    $id = $_POST['item_komisi'];
    $query = mysqli_query($koneksi, "SELECT KODE_BARANG, NAMA_BARANG, JENIS, NAMA_KATEGORI FROM daftar_baru JOIN kategori ON daftar_baru.KODE_JENIS = kategori.KODE_KATEGORI WHERE KODE_KOMISI = '".$id."'");
    $data = array();
    $a = 1;
    while($result = mysqli_fetch_array($query)){
        $inc = array($a, $result['KODE_BARANG'], $result['NAMA_BARANG'], $result['NAMA_KATEGORI']);
        array_push($data, $inc);
        $a++;
    }
    $json = json_encode($data);
    echo $json;
    // echo "SELECT KODE_BARANG, NAMA_BARANG, JENIS FROM daftar_baru WHERE KODE_KOMISI = '".$id."'";
}

if (isset($_POST['pinjam_detail'])) {
    $id = $_POST['pinjam_detail'];
    $myObj = array();
    $a = 1;
    // $query = mysqli_query($koneksi, "SELECT p.id_detil_pinjam, a.nama_aset, b.nama_barang FROM detail_peminjaman p JOIN daftar_aset a ON p.id_aset = a.id_aset JOIN detil_usulan_pengadaan pd ON a.id_usulan_tambah = pd.id_usulan_tambah JOIN barang b ON pd.id_barang = b.id_barang WHERE p.id_peminjaman = '".$id."'");
    $query = mysqli_query($koneksi, "SELECT p.id_detil_pinjam, a.nama_barang, b.nama_kategori FROM detail_peminjaman p JOIN daftar_baru a ON p.id_aset = a.id_aset JOIN kategori b ON a.kode_jenis = b.kode_kategori WHERE p.id_peminjaman = '".$id."'");
    while($row = mysqli_fetch_array($query)){
        $nama = $row['nama_barang'];
        $barang = $row['nama_kategori'];
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