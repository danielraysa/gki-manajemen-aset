<?php

    include "../connection.php";
    
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM pengadaan WHERE id_pengadaan = '".$id."'");
        $row = mysqli_fetch_array($query);
        $id = $row['id_pengadaan'];
        $nama = $row['barang_usulan'];
        $barang = $row['id_barang'];
        //$jumlah = $row['jumlah'];
        $harga = $row['harga'];
        $keterangan = $row['keterangan_usulan'];

        //$myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'jumlah' => $jumlah, 'harga' => $harga, 'keterangan' => $keterangan);
        $myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga, 'keterangan' => $keterangan);
        
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>