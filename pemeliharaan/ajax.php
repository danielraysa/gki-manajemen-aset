<?php
    session_start();
    include "../connection.php";
    
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

    if(isset($_POST['jadwal_custom'])) {
        $id_aset = $_POST['id_aset'];
        $tgl = $_POST['tgl_pemeliharaan'];
        $notif = $_POST['notifikasi'];
        $date = str_replace('/', '-', $tgl);
        echo $date."\n";
        $tgl_awal = date("Y-m-d", strtotime(substr($date,0,10)));
        echo $tgl_awal."\n";
        $pilihan = $_POST['pilihan'];
        $random_id = randomID('pemeliharaan_berkala', 'ID_PENJADWALAN', 10);
        //$satuan = $_POST['satuan'];
        /* if($satuan == "Bulan") {
            $bulan_awal = date('n', $tgl_awal);
            $bulan_akhir = date('n', $tgl_akhir);
        } */
        //$jml = $_POST['jumlah'];
        //echo $tgl;
        $date = str_replace('/', '-', $tgl);
        //echo $date."\n";
        $tgl_awal = date("Y-m-d", strtotime(substr($date,0,10)));
        echo $tgl_awal."\n";
        $tgl_akhir = date("Y-m-d", strtotime(substr($date,13)));
        echo $tgl_akhir."\n";
        
        $date1=date_create($tgl_awal);
        $date2=date_create($tgl_akhir);
        $diff=date_diff($date1, $date2);
        $range = $diff->format("%a");
        //echo $diff->format("%R%a days | ");
        $interval = round($range/$jml);
        //echo $interval;
        $newdate = date('Y-m-d', strtotime($tgl_awal. ' +'.$interval.' days'));
        for($x = 1; $x <= $jml; $x++) {
            $random_id = randString(10);
            $is_unique = false;
            while (!$is_unique) {
                $select = mysqli_query($koneksi, "SELECT * FROM pemeliharaan_aset WHERE ID_PEMELIHARAAN = '".$random_id."'");
                if (mysqli_num_rows($select) == 0) {  
                    // if you don't get a result, then you're good
                    $is_unique = true;
                    ECHO "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, STATUS_PEMELIHARAAN) VALUES ('".$random_id."','".$id_aset."','".$newdate."','Aktif') \n";
                    $query = mysqli_query($koneksi, "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, STATUS_PEMELIHARAAN) VALUES ('".$random_id."','".$id_aset."','".$newdate."','Aktif')");
                    if(!$query) {
                        $_SESSION['error-msg'] = mysqli_error($koneksi);
                        echo $_SESSION['error-msg'];
                        break;
                    } 
                }
                else {
                    $random_id = randString(10);
                }
            }
            $newdate = date('Y-m-d', strtotime($newdate.' +'.$interval.' days'));
        }
        /* $myObj = array('id_aset' => $id, 'kode_aset' => $tgl_awal, 'nama_aset' => $tgl_akhir);
        $myJSON = json_encode($myObj);
        echo $myJSON; */
    }

    if(isset($_POST['add_jadwal'])) {
        $id_aset = $_POST['id_aset'];
        $tgl = $_POST['tgl_pemeliharaan'];
        $notif = $_POST['notifikasi'];
        $date = str_replace('/', '-', $tgl);
        echo $date."\n";
        $tgl_awal = date("Y-m-d", strtotime(substr($date,0,10)));
        echo $tgl_awal."\n";
        $pilihan = $_POST['pilihan'];
        
        /* switch ($pilihan) {
            case "bulan":
                ECHO "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, KUSTOM, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Tidak','Aktif')";
                $query = mysqli_query($koneksi, "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, KUSTOM, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Tidak','Aktif')");
                break;
            case "awal_bulan":
                ECHO "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, KUSTOM, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Tidak','Aktif')";
                $query = mysqli_query($koneksi, "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, KUSTOM, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Tidak','Aktif')");
                break;
            case "akhir_bulan":
                ECHO "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, KUSTOM, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Tidak','Aktif')";
                $query = mysqli_query($koneksi, "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, KUSTOM, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Tidak','Aktif')");
                break;
            case "tahun":
                ECHO "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, KUSTOM, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Tidak','Aktif')";
                $query = mysqli_query($koneksi, "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, KUSTOM, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Tidak','Aktif')");
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        } */
        //$tgl_akhir = date("Y-m-d", strtotime(substr($date,13)));
        //echo $tgl_akhir."\n";
        if($pilihan != "sekali"){
            $random_id = randomID('pemeliharaan_berkala', 'ID_PENJADWALAN', 10);
            ECHO "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, KUSTOM, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Tidak','Aktif') \n";
            $query = mysqli_query($koneksi, "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, KUSTOM, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Tidak','Aktif')");
        }
        /* $random_id = randString(10);
        $is_unique = false; */
        $random_id_new = randomID('pemeliharaan_aset', 'ID_PEMELIHARAAN', 10);
        
        ECHO "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, NOTIF, STATUS_PEMELIHARAAN) VALUES ('".$random_id_new."','".$id_aset."','".$tgl_awal."',".$notif.",'Aktif') \n";
        $query_new = mysqli_query($koneksi, "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, NOTIF, STATUS_PEMELIHARAAN) VALUES ('".$random_id_new."','".$id_aset."','".$tgl_awal."',".$notif.",'Aktif')");

        /* while (!$is_unique) {
            $select = mysqli_query($koneksi, "SELECT * FROM pemeliharaan_aset WHERE ID_PEMELIHARAAN = '".$random_id."'");
            if (mysqli_num_rows($select) == 0) {  
                // if you don't get a result, then you're good
                $is_unique = true;
                ECHO "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, STATUS_PEMELIHARAAN) VALUES ('".$random_id."','".$id_aset."','".$tgl_awal."','Aktif') \n";
                $query = mysqli_query($koneksi, "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, STATUS_PEMELIHARAAN) VALUES ('".$random_id."','".$id_aset."','".$tgl_awal."','Aktif')");
                if(!$query) {
                    $_SESSION['error-msg'] = mysqli_error($koneksi);
                    echo $_SESSION['error-msg'];
                    break;
                }
            }
            else {
                $random_id = randString(10);
            }
        } */
        /* $myObj = array('id_aset' => $id, 'kode_aset' => $tgl_awal, 'nama_aset' => $tgl_akhir);
        $myJSON = json_encode($myObj);
        echo $myJSON; */
    }
    
    if(isset($_POST['id_maint'])) {
        $id = $_POST['id_maint'];
        $query = mysqli_query($koneksi, "SELECT p.ID_PEMELIHARAAN, d.KODE_ASET, d.NAMA_ASET, p.ID_ASET, p.TANGGAL_PENJADWALAN FROM pemeliharaan_aset p JOIN daftar_aset d ON p.ID_ASET = d.ID_ASET WHERE p.ID_PEMELIHARAAN = '".$id."'");
        $fetch = mysqli_fetch_array($query);
        $kode = $fetch['KODE_ASET'];
        $nama = $fetch['NAMA_ASET'];
        $tgl = date('d/m/Y', strtotime($fetch['TANGGAL_PENJADWALAN']));
        //$tgl = $fetch['TANGGAL_PENJADWALAN'];
        $myObj = array('id_maint' => $id, 'kode_aset' => $kode, 'nama_aset' => $nama, 'tgl_jadwal' => $tgl);
        //$myObj = array('kode_aset' => $kode, 'nama_aset' => $nama);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

    if(isset($_POST['id_maintenance'])) {
        $id_maintenance = $_POST['id_maintenance'];
        $tgl = $_POST['tgl_pemeliharaan'];
        $tgl2 = $_POST['tgl_selesai'];
        $date = str_replace('/', '-', $tgl);
        $date2 = str_replace('/', '-', $tgl2);
        //echo $date."\n";
        $tgl_pemeliharaan = date("Y-m-d", strtotime($date));
        $tgl_selesai = date("Y-m-d", strtotime($date2));
        //echo $tgl_pemeliharaan."\n";
        $abc = $_POST['biaya'];
        $def = str_replace('.', '', $abc);
        $biaya = str_replace('Rp', '', $def);
        $keterangan = $_POST['keterangan'];
        //echo "UPDATE pemeliharaan_aset SET TANGGAL_PEMELIHARAAN = '".$tgl_pemeliharaan."', BIAYA_PEMELIHARAAN = '".$biaya."', HASIL_PEMELIHARAAN = '".$keterangan."' WHERE ID_PEMELIHARAAN = '".$id_maintenance."'";
        $query = mysqli_query($koneksi, "UPDATE pemeliharaan_aset SET TANGGAL_PEMELIHARAAN = '".$tgl_pemeliharaan."', SELESAI_PEMELIHARAAN = '".$tgl_selesai."', BIAYA_PEMELIHARAAN = '".$biaya."', HASIL_PEMELIHARAAN = '".$keterangan."', STATUS_PEMELIHARAAN = 'Selesai' WHERE ID_PEMELIHARAAN = '".$id_maintenance."'");
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