<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM merk WHERE ID_MERK = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['ID_MERK'];
        $nama = $row['NAMA_MERK'];
        $myObj = array('id' => $id, 'nama' => $nama);
    }
    $myJSON = json_encode($myObj);
    echo $myJSON;

?>