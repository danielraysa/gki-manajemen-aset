<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['id_kategori'];
        $nama = $row['nama_kategori'];
        $kode = $row['kode_kategori'];

        $myObj = array('id' => $id, 'nama' => $nama, 'kode' => $kode);
    
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>