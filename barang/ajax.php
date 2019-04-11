<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT B.ID_BARANG, B.NAMA_BARANG, B.ID_KATEGORI, K.NAMA_KATEGORI FROM BARANG B JOIN KATEGORI K ON B.ID_KATEGORI = K.ID_KATEGORI WHERE B.ID_BARANG = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['ID_BARANG'];
        $nama = $row['NAMA_BARANG'];
        $kategori = $row['ID_KATEGORI'];
        //$merk = $row['merk'];
        //$serimodel = $row['seri_model'];

        $myObj = array('id' => $id, 'nama' => $nama, 'kategori' => $kategori);
    
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>