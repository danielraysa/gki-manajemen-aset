<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM komisi_jemaat WHERE ID_KOMISI = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['ID_KOMISI'];
        $nama = $row['NAMA_KOMISI'];
        $kode = $row['KODE_KOMISI'];

        $myObj = array('id' => $id, 'nama' => $nama, 'kode' => $kode);
    
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>