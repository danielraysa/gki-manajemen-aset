<?php
    session_start();
    include "../connection.php";

    setlocale(LC_NUMERIC, 'INDONESIA');
    function asRupiah($value) {
        return 'Rp. ' . number_format($value);
    }

    // kosongin item
    if(isset($_POST['empty'])){
        unset($_SESSION['temp_hapus']);
        //header("location:../penghapusan");
    }

    if(isset($_POST['usulan-hapus'])) {
        $id = $_POST['usulan-hapus'];
        $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.NAMA_ASET, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, SUM(CASE WHEN p.STATUS_PEMELIHARAAN = 'SELESAI' THEN +1 ELSE 0 END) as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM daftar_aset d LEFT OUTER JOIN pemeliharaan_aset p ON d.ID_ASET = p.ID_ASET WHERE d.ID_ASET = '".$id."'");
        //$query = mysqli_query($koneksi, "SELECT * FROM daftar_aset WHERE ID_ASET = '".$id."'"); 
        $row = mysqli_fetch_array($query);
        $id_aset = $row['ID_ASET'];
        $nama_aset = $row['NAMA_ASET'];
        $umur = $row['DIFF'];
        $jml_pemeliharaan = $row['JML_PEMELIHARAAN'];
        $bagi = ($row['HARGA_PEMBELIAN']-$row['NILAI_RESIDU'])/$row['MASA_MANFAAT'];
        $nilai = $row['HARGA_PEMBELIAN']-($bagi*($row['MASA_MANFAAT']-$row['DIFF']));
        $random_id = rand();
        $rand_bool = false;
        while($rand_bool = false) {
            if (in_array($random_id, $_SESSION['temp_hapus'])) {
                $random_id = rand();
            }
            else {
                $rand_bool = true;
            }
        }
        $add = array('temp_id' => $random_id, 'id_aset' => $id_aset, 'nama' => $nama_aset, 'umur' => $umur, 'jumlah_pemeliharaan' => $jml_pemeliharaan, 'nilai' => $nilai);
        array_push($_SESSION['temp_hapus'], $add);
        //echo $_SESSION['temp_hapus'];
        //header("location: ../penghapusan/");
    }

    // approve penghapusan
    if (isset($_GET['approve'])) {
        $id = $_GET['approve'];
        $query = mysqli_query($koneksi, "UPDATE penghapusan_aset SET HASIL_APPROVAL = 'Diterima' WHERE ID_penghapusan = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
    }

    if (isset($_GET['reject'])) {
        $id = $_GET['reject'];
        $query = mysqli_query($koneksi, "UPDATE penghapusan_aset SET HASIL_APPROVAL = 'Ditolak' WHERE ID_penghapusan = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }    
    }
    if (isset($_POST['delete-usulan'])) {
        $id = $_POST['delete-usulan'];
        $query = mysqli_query($koneksi, "UPDATE penghapusan_aset SET STATUS_USULAN = 'Dihapus' WHERE ID_penghapusan = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
    }

    if (isset($_POST['usulan_detail'])) {
        $id = $_POST['usulan_detail'];
        $myObj = array();
        $a = 1;
        $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.NAMA_ASET, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, SUM(CASE WHEN p.STATUS_PEMELIHARAAN = 'SELESAI' THEN +1 ELSE 0 END) as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM daftar_aset d LEFT OUTER JOIN pemeliharaan_aset p ON d.ID_ASET = p.ID_ASET JOIN detil_usulan_hapus dp ON dp.ID_ASET = d.ID_ASET WHERE dp.ID_PENGADAAN = '".$id."'");
        //$query = mysqli_query($koneksi, "SELECT * FROM daftar_aset WHERE ID_ASET = '".$id."'"); 
        while($row = mysqli_fetch_array($query)){
            $id_aset = $row['ID_ASET'];
            $nama_aset = $row['NAMA_ASET'];
            $umur = $row['DIFF'];
            $jml_pemeliharaan = $row['JML_PEMELIHARAAN'];
            $bagi = ($row['HARGA_PEMBELIAN']-$row['NILAI_RESIDU'])/$row['MASA_MANFAAT'];
            $nilai = $row['HARGA_PEMBELIAN']-($bagi*($row['MASA_MANFAAT']-$row['DIFF']));
            
            $add = array('no' => $a, 'id_aset' => $id_aset, 'nama' => $nama_aset, 'umur' => $umur, 'jumlah_pemeliharaan' => $jml_pemeliharaan, 'nilai' => $nilai);
            array_push($myObj, $add);
        }
        /* 
        $query = mysqli_query($koneksi, "SELECT d.barang_usulan, b.nama_barang, p.harga FROM detil_usulan_penghapusan p JOIN barang b ON p.id_barang = b.id_barang WHERE p.id_penghapusan = '".$id."'");
        while($row = mysqli_fetch_array($query)){
            $nama = $row['barang_usulan'];
            $barang = $row['nama_barang'];
            $harga = str_replace(',','.',asRupiah($row['harga']));
            //$array = array('nomor' => $a, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga);
            $array = array($a, $nama, $barang, $harga);
            array_push($myObj, $array);
            $a++;
        } */
        //$myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga, 'keterangan' => $keterangan);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }
    
    if(isset($_POST['id-insert'])) {
        $id = $_POST['id-insert'];
        //$query = mysqli_query($koneksi, "SELECT p.barang_usulan, p.id_barang, b.nama_barang, p.harga FROM penghapusan_barang p JOIN barang b ON p.id_barang = b.id_barang WHERE p.id_temp = '".$id."'");
        $query = mysqli_query($koneksi, "SELECT p.barang_usulan, p.id_barang, b.nama_barang, p.harga FROM detil_usulan_penghapusan p JOIN barang b ON p.id_barang = b.id_barang WHERE p.id_usulan_tambah = '".$id."'");
        $row = mysqli_fetch_array($query);
        $nama = $row['barang_usulan'];
        $barang = $row['id_barang'];
        $harga = $row['harga'];
        $myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

?>