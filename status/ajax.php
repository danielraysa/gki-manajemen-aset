<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM status WHERE id_status = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['id_status'];
        $nama = $row['nama_status'];

        $myObj = array('id' => $id, 'nama' => $nama);
    
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>