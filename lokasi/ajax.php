<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM ruangan WHERE ID_RUANGAN = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['ID_RUANGAN'];
        $nama = $row['NAMA_RUANGAN'];
        $kode = $row['KODE_RUANGAN'];

        $myObj = array('id' => $id, 'nama' => $nama, 'kode' => $kode);
    
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>