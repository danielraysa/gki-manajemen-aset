<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM ruangan WHERE id_ruangan = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['id_ruangan'];
        $nama = $row['nama_ruangan'];
        $kode = $row['kode_ruangan'];

        $myObj = array('id' => $id, 'nama' => $nama, 'kode' => $kode);
    
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>