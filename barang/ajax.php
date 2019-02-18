<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT b.id_barang, b.nama_barang, b.id_kategori, k.nama_kategori, b.merk, b.seri_model FROM barang b JOIN kategori k ON b.id_kategori = k.id_kategori WHERE b.id_barang = ".$id."");
        $row = mysqli_fetch_array($query);
        $id = $row['id_barang'];
        $nama = $row['nama_barang'];
        $kategori = $row['id_kategori'];
        $merk = $row['merk'];
        $serimodel = $row['seri_model'];

        $myObj = array('id' => $id, 'nama' => $nama, 'kategori' => $kategori, 'merk' => $merk, 'serimodel' => $serimodel);
    
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>