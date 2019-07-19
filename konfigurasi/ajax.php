<?php

    include "../connection.php";
    
    if (isset($_POST['ID'])) {
        $id = $_POST['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM daftar_aset WHERE ID_ASET = '".$id."'");
        $row = mysqli_fetch_array($query);
        $nama = $row['NAMA_ASET'];
        $kode = $row['KODE_ASET'];
        $merk = $row['ID_MERK'];
        $komisi = $row['ID_KOMISI'];
        $ruangan = $row['ID_RUANGAN'];
        $seri = $row['SERI_MODEL'];
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