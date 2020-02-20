<?php

    include "../connection.php";
    
    if (isset($_POST['ID'])) {
        $id = $_POST['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM daftar_baru WHERE ID_BARANG = '".$id."'");
        $row = mysqli_fetch_array($query);
        $nama = $row['NAMA_BARANG'];
        $kode = $row['KODE_BARANG'];
        $merk = $row['MERK'];
        $komisi = $row['KOMISI'];
        $ruangan = $row['LOKASI_BARANG'];
        $seri = "";
        if(!empty($row['FOTO_ASET'])){
            $foto = $row['FOTO_ASET'];
            $myObj = array('id' => $id, 'nama' => $nama, 'kode' => $kode, 'ruangan' => $ruangan, 'komisi' => $komisi, 'seri' => $seri, 'merk' => $merk, 'foto' => $foto);
        }
        else {
            $myObj = array('id' => $id, 'nama' => $nama, 'kode' => $kode, 'ruangan' => $ruangan, 'komisi' => $komisi, 'seri' => $seri, 'merk' => $merk, 'foto' => 'blank');
        }
    }

    $myJSON = json_encode($myObj);
    echo $myJSON;

?>