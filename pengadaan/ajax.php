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
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }
    if (isset($_GET['approve'])) {
        $id = $_GET['approve'];
        $query = mysqli_query($koneksi, "UPDATE pengadaan SET hasil_approval = 'Approved' WHERE id_pengadaan = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
        //$myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'jumlah' => $jumlah, 'harga' => $harga, 'keterangan' => $keterangan);
    }
    if (isset($_GET['reject'])) {
        $id = $_GET['reject'];
        $query = mysqli_query($koneksi, "UPDATE pengadaan SET hasil_approval = 'Rejected' WHERE id_pengadaan = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
        //$myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'jumlah' => $jumlah, 'harga' => $harga, 'keterangan' => $keterangan);
        
    }
    

?>