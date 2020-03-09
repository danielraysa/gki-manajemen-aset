<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE ID_USER = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['ID_USER'];
        $nama = $row['NAMA_LENGKAP'];
        $username = $row['USERNAME'];
        $password = $row['PASSWORD'];
        $hak_akses = $row['ROLE'];
        $no_hp = $row['NO_HP'];
        //$keterangan = $row['KETERANGAN'];

        $myObj = array('id' => $id, 'nama' => $nama, 'username' => $username, 'password' => $password, 'role' => $hak_akses, 'no_hp' => $no_hp);
    
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>