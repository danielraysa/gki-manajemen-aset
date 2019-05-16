<?php

session_start();
include "connection.php";

if(isset($_POST['ruangan'])) {
    $query = mysqli_query($koneksi, "SELECT r.NAMA_RUANGAN as ruangan, COUNT(d.ID_RUANGAN) as jumlah FROM daftar_aset d JOIN ruangan r ON d.ID_RUANGAN = r.ID_RUANGAN GROUP BY d.ID_RUANGAN");
    $data = array();
    while($result = mysqli_fetch_array($query)){
        $inc = array('ruangan' => $result['ruangan'], 'jumlah' => $result['jumlah']);
        array_push($data, $inc);
    }
    //now print the data
    $json = json_encode($data);
    echo $json;
}

if(isset($_POST['komisi'])) {
    $query = mysqli_query($koneksi, "SELECT r.NAMA_KOMISI as komisi, COUNT(d.ID_KOMISI) as jumlah FROM daftar_aset d JOIN komisi_jemaat r ON d.ID_KOMISI = r.ID_KOMISI GROUP BY d.ID_KOMISI");
    $data = array();
    while($result = mysqli_fetch_array($query)){
        $inc = array('komisi' => $result['komisi'], 'jumlah' => $result['jumlah']);
        array_push($data, $inc);
    }

    $json = json_encode($data);
    //now print the data
    echo $json;
}

?>