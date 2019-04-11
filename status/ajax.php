<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM status WHERE ID_STATUS = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['ID_STATUS'];
        $nama = $row['NAMA_STATUS'];

        $myObj = array('id' => $id, 'nama' => $nama);
    
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>