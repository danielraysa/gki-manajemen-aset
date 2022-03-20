<?php
session_start();
include "connection.php";

if(isset($_POST['ruangan'])) {
    $query = mysqli_query($koneksi, "SELECT d.RUANGAN_BARANG as id_ruangan, r.NAMA_RUANGAN as ruangan, COUNT(d.RUANGAN_BARANG) as jumlah FROM daftar_baru d JOIN ruangan r ON d.RUANGAN_BARANG = r.ID_RUANGAN GROUP BY d.RUANGAN_BARANG");
    $data = array();
    while($result = mysqli_fetch_array($query)){
        $inc = array('id' => $result['id_ruangan'], 'ruangan' => $result['ruangan'], 'jumlah' => $result['jumlah']);
        // $inc = array('id' => $result['LOKASI_BARANG'], 'ruangan' => $result['LOKASI_BARANG'], 'jumlah' => $result['JUMLAH']);
        array_push($data, $inc);
    }
    $json = json_encode($data);
    echo $json;
}
if(isset($_POST['item_ruangan'])) {
    $id = $_POST['item_ruangan'];
    $query = mysqli_query($koneksi, "SELECT d.KODE_BARANG, d.NAMA_BARANG, k.NAMA_KATEGORI FROM daftar_baru d JOIN barang b ON d.JENIS_BARANG = b.ID_BARANG JOIN kategori k ON b.ID_KATEGORI = k.ID_KATEGORI JOIN ruangan r ON d.RUANGAN_BARANG = r.ID_RUANGAN WHERE d.RUANGAN_BARANG = '".$id."'");
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
    $query = mysqli_query($koneksi, "SELECT k.KODE_KOMISI, k.NAMA_KOMISI, count(d.KODE_KOMISI) JUMLAH FROM daftar_baru d JOIN komisi_jemaat k ON d.KODE_KOMISI = k.KODE_KOMISI GROUP BY k.KODE_KOMISI, k.NAMA_KOMISI");
    $data = array();
    while($result = mysqli_fetch_array($query)){
        $inc = array('id' => $result['KODE_KOMISI'], 'komisi' => $result['NAMA_KOMISI'], 'jumlah' => $result['JUMLAH']);
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
    $query = mysqli_query($koneksi, "SELECT p.id_detil_pinjam, a.nama_barang, m.nama_merk, k.nama_kategori FROM detail_peminjaman p JOIN daftar_baru a ON p.id_aset = a.id_aset JOIN barang b ON a.jenis_barang = b.id_barang JOIN kategori k ON b.id_kategori = k.id_kategori JOIN merk m ON a.id_merk = m.id_merk WHERE p.id_peminjaman = '".$id."'");
    while($row = mysqli_fetch_array($query)){
        $nama = $row['nama_barang'];
        $barang = $row['nama_kategori'];
        $merk = $row['nama_merk'];
        $id_item = $row['id_detil_pinjam'];
        
        $array = array($a, $nama, $merk, $barang);
        array_push($myObj, $array);
        $a++;
    }
    echo json_encode($myObj);
}

?>