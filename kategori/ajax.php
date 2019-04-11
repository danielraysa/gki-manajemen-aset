<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE ID_KATEGORI = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['ID_KATEGORI'];
        $nama = $row['NAMA_KATEGORI'];
        $kode = $row['KODE_KATEGORI'];

        $myObj = array('id' => $id, 'nama' => $nama, 'kode' => $kode);
    
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>