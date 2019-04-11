<?php
    session_start();
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
    
    if(isset($_POST['id_aset'])) {
        $query = mysqli_query($koneksi, "SELECT * FROM daftar_aset WHERE ID_ASET = '".$_POST['id_aset']."'");
        $fetch = mysqli_fetch_array($query);
        $id = $_POST['id_aset'];
        $kode = $fetch['KODE_ASET'];
        $nama = $fetch['NAMA_ASET'];
        $myObj = array('id_aset' => $id, 'kode_aset' => $kode, 'nama_aset' => $nama);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

    if(isset($_POST['add_jadwal'])) {
        $id_aset = $_POST['id_aset'];
        $tgl = $_POST['tgl_pemeliharaan'];
        $date = str_replace('/', '-', $tgl);
        echo $date."<br>";
        $tgl_awal = date("Y-m-d", strtotime(substr($date,0,10)));
        echo $tgl_awal."<br>";
        $tgl_akhir = date("Y-m-d", strtotime(substr($date,13)));
        echo $tgl_akhir."<br>";
        $random_id = randString(10);
        $is_unique = false;
            
        while (!$is_unique) {
            $select = mysqli_query($koneksi, "SELECT * FROM pemeliharaan_aset WHERE ID_PEMELIHARAAN = '".$random_id."'");
            if (mysqli_num_rows($select) == 0) {  
                // if you don't get a result, then you're good
                $is_unique = true;
                ECHO "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, BATAS_PENJADWALAN, STATUS_PEMELIHARAAN) VALUES ('".$random_id."','".$id_aset."','".$tgl_awal."','".$tgl_akhir."','Aktif') <br>";
                $query = mysqli_query($koneksi, "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, BATAS_PENJADWALAN, STATUS_PEMELIHARAAN) VALUES ('".$random_id."','".$id_aset."','".$tgl_awal."','".$tgl_akhir."','Aktif')");
                if(!$query) {
                    $_SESSION['error-msg'] = mysqli_error($koneksi);
                    echo $_SESSION['error-msg'];
                    //header("location: ../pengadaan/?error");
                    //$success = false;
                    break;
                }
            }
            else {
                $random_id = randString(10);
            }
        }

        $myObj = array('id_aset' => $id, 'kode_aset' => $tgl_awal, 'nama_aset' => $tgl_akhir);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

    if(isset($_POST['id_maintenance'])) {
        $id_maintenance = $_POST['id_maintenance'];
        $tgl = $_POST['tgl_pemeliharaan'];
        $date = str_replace('/', '-', $tgl);
        echo $date."<br>";
        $tgl_pemeliharaan = date("Y-m-d", strtotime($date));
        echo $tgl_pemeliharaan."<br>";
        $abc = $_POST['biaya'];
        $def = str_replace('.', '', $abc);
        $biaya = str_replace('Rp', '', $def);
        $keterangan = $_POST['keterangan'];
        echo "UPDATE pemeliharaan_aset SET TANGGAL_PEMELIHARAAN = '".$tgl_pemeliharaan."', BIAYA_PEMELIHARAAN = '".$biaya."', HASIL_PEMELIHARAAN = '".$keterangan."' WHERE ID_PEMELIHARAAN = '".$id_maintenance."'";
        $query = mysqli_query($koneksi, "UPDATE pemeliharaan_aset SET TANGGAL_PEMELIHARAAN = '".$tgl_pemeliharaan."', BIAYA_PEMELIHARAAN = '".$biaya."', HASIL_PEMELIHARAAN = '".$keterangan."' WHERE ID_PEMELIHARAAN = '".$id_maintenance."'");

        if(!$query) {
            echo mysqli_error($koneksi);
        }   
    }
    if(isset($_POST['id_cancel'])) {
        $id_maintenance = $_POST['id_cancel'];
        
        echo "UPDATE pemeliharaan_aset SET STATUS_PEMELIHARAAN = 'Dihapus' WHERE ID_PEMELIHARAAN = '".$id_maintenance."'";
        $query = mysqli_query($koneksi, "UPDATE pemeliharaan_aset SET STATUS_PEMELIHARAAN = 'Dihapus' WHERE ID_PEMELIHARAAN = '".$id_maintenance."'");

        if(!$query) {
            echo mysqli_error($koneksi);
        }   
    }

?>