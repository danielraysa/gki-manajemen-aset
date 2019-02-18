<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM komisi WHERE id_komisi = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['id_komisi'];
        $nama = $row['nama_komisi'];
        $kode = $row['kode_komisi'];

        $myObj = array('id' => $id, 'nama' => $nama, 'kode' => $kode);
    
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>