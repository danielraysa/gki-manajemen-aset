<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE id = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['id'];
        $nama = $row['nama'];
        $username = $row['username'];
        $password = $row['password'];
        $hak_akses = $row['role'];
        $keterangan = $row['keterangan'];

        $myObj = array('id' => $id, 'nama' => $nama, 'username' => $username, 'password' => $password, 'role' => $hak_akses, 'keterangan' => $keterangan);
    
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>