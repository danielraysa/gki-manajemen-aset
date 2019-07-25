<?php
    session_start();
    
    include "../connection.php";
    
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

    if(isset($_POST['cek_jadwal'])) {
        $id = $_POST['cek_jadwal'];
        $query = mysqli_query($koneksi, "SELECT * FROM pemeliharaan_berkala p JOIN daftar_aset d ON p.ID_ASET = d.ID_ASET WHERE p.ID_PENJADWALAN = '".$id."'");
        $fetch = mysqli_fetch_array($query);
        $id_aset = $fetch['ID_ASET'];
        $kode = $fetch['KODE_ASET'];
        $nama = $fetch['NAMA_ASET'];
        $pilihan = $fetch['PILIHAN'];
        $frekuensi = $fetch['FREKUENSI'];
        $jarak = $fetch['JARAK_INTERVAL'];
        $query2 = mysqli_query($koneksi, "SELECT * FROM pemeliharaan_aset WHERE ID_ASET = '".$id_aset."' ORDER BY TANGGAL_PENJADWALAN DESC");
        $fetch2 = mysqli_fetch_array($query2);
        $tgl = $fetch2['TANGGAL_PENJADWALAN'];
        $notif = $fetch2['NOTIF'];
        $myObj = array('id_pemeliharaan' => $id, 'id_aset' => $id_aset, 'kode_aset' => $kode, 'nama_aset' => $nama, 'pilihan' => $pilihan, 'frekuensi' => $frekuensi, 'interval' => $jarak, 'tanggal_jadwal' => $tgl, 'notif' => $notif);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

    if(isset($_POST['jadwal_custom'])) {
        $id_aset = $_POST['id_aset'];
        $tgl = $_POST['tgl_pemeliharaan'];
        $notif = $_POST['notifikasi'];
        $pilihan = $_POST['pilihan'];
        $interval = $_POST['interval'];
        $satuan = $_POST['satuan'];
        $date = str_replace('/', '-', $tgl);
        echo $date."\n";
        $tgl_awal = date("Y-m-d", strtotime(substr($date,0,10)));
        echo $tgl_awal."\n";

        $random_id = randomID('pemeliharaan_berkala', 'ID_PENJADWALAN', 10);
        ECHO "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, FREKUENSI, JARAK_INTERVAL, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','".$satuan."','".$interval."','Aktif') \n";
        $query = mysqli_query($koneksi, "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, FREKUENSI, JARAK_INTERVAL, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','".$satuan."','".$interval."','Aktif')");
        
        $random_id_new = randomID('pemeliharaan_aset', 'ID_PEMELIHARAAN', 10);
        ECHO "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, NOTIF, STATUS_PEMELIHARAAN) VALUES ('".$random_id_new."','".$id_aset."','".$tgl_awal."',".$notif.",'Aktif') \n";
        $query_new = mysqli_query($koneksi, "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, NOTIF, STATUS_PEMELIHARAAN) VALUES ('".$random_id_new."','".$id_aset."','".$tgl_awal."',".$notif.",'Aktif')");
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
        
        if($pilihan != "sekali"){
            $random_id = randomID('pemeliharaan_berkala', 'ID_PENJADWALAN', 10);
            ECHO "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Aktif') \n";
            $query = mysqli_query($koneksi, "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Aktif')");
            if($pilihan == 'awal_bulan'){
                $tgl_temp = date('Y-m-d');
                $month = date('Y-m',strtotime($tgl_temp. ' +1 month'));
                $tgl_awal = date($month.'-01');
            }
            if($pilihan == 'akhir_bulan'){
                $tgl_temp = date('Y-m-d');
                $tgl_awal = date('Y-m-t', strtotime($tgl_temp. ' +1 month'));
            }
        }
        
        $random_id_new = randomID('pemeliharaan_aset', 'ID_PEMELIHARAAN', 10);
        
        ECHO "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, NOTIF, STATUS_PEMELIHARAAN) VALUES ('".$random_id_new."','".$id_aset."','".$tgl_awal."',".$notif.",'Aktif') \n";
        $query_new = mysqli_query($koneksi, "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, NOTIF, STATUS_PEMELIHARAAN) VALUES ('".$random_id_new."','".$id_aset."','".$tgl_awal."',".$notif.",'Aktif')");

    }
    
    if(isset($_POST['edit_jadwal'])) {
        $id_aset = $_POST['id_penjadwalan'];
        $tgl = $_POST['tgl_pemeliharaan'];
        $notif = $_POST['notifikasi'];
        $date = str_replace('/', '-', $tgl);
        echo $date."\n";
        $tgl_awal = date("Y-m-d", strtotime(substr($date,0,10)));
        echo $tgl_awal."\n";
        $pilihan = $_POST['pilihan'];
        
        if($pilihan != "sekali"){
            $random_id = randomID('pemeliharaan_berkala', 'ID_PENJADWALAN', 10);
            ECHO "UPDATE pemeliharaan_berkala ID_PENJADWALAN, ID_ASET, PILIHAN, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Aktif') \n";
            ECHO "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Aktif') \n";
            $query = mysqli_query($koneksi, "INSERT INTO pemeliharaan_berkala (ID_PENJADWALAN, ID_ASET, PILIHAN, STATUS_BERKALA) VALUES ('".$random_id."','".$id_aset."','".$pilihan."','Aktif')");
            if($pilihan == 'awal_bulan'){
                $tgl_temp = date('Y-m-d');
                $month = date('Y-m',strtotime($tgl_temp. ' +1 month'));
                $tgl_awal = date($month.'-01');
            }
            if($pilihan == 'akhir_bulan'){
                $tgl_temp = date('Y-m-d');
                $tgl_awal = date('Y-m-t', strtotime($tgl_temp. ' +1 month'));
            }
        }
        
        $random_id_new = randomID('pemeliharaan_aset', 'ID_PEMELIHARAAN', 10);
        
        ECHO "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, NOTIF, STATUS_PEMELIHARAAN) VALUES ('".$random_id_new."','".$id_aset."','".$tgl_awal."',".$notif.",'Aktif') \n";
        $query_new = mysqli_query($koneksi, "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, NOTIF, STATUS_PEMELIHARAAN) VALUES ('".$random_id_new."','".$id_aset."','".$tgl_awal."',".$notif.",'Aktif')");

    }
    if(isset($_POST['matikan_jadwal'])) {
        $id_maintenance = $_POST['id_cancel'];
        
        echo "UPDATE pemeliharaan_aset SET STATUS_PEMELIHARAAN = 'Dihapus' WHERE ID_PEMELIHARAAN = '".$id_maintenance."'";
        $query = mysqli_query($koneksi, "UPDATE pemeliharaan_aset SET STATUS_PEMELIHARAAN = 'Dihapus' WHERE ID_PEMELIHARAAN = '".$id_maintenance."'");

        if(!$query) {
            echo mysqli_error($koneksi);
        }
        
    }
    if(isset($_POST['id_maint'])) {
        $id = $_POST['id_maint'];
        $query = mysqli_query($koneksi, "SELECT p.ID_PEMELIHARAAN, d.KODE_ASET, d.NAMA_ASET, p.ID_ASET, p.TANGGAL_PENJADWALAN FROM pemeliharaan_aset p JOIN daftar_aset d ON p.ID_ASET = d.ID_ASET WHERE p.ID_PEMELIHARAAN = '".$id."'");
        $fetch = mysqli_fetch_array($query);
        $aset = $fetch['ID_ASET'];
        $kode = $fetch['KODE_ASET'];
        $nama = $fetch['NAMA_ASET'];
        $tgl = date('d/m/Y', strtotime($fetch['TANGGAL_PENJADWALAN']));
        //$tgl = $fetch['TANGGAL_PENJADWALAN'];
        $myObj = array('id_maint' => $id, 'id_aset' => $aset, 'kode_aset' => $kode, 'nama_aset' => $nama, 'tgl_jadwal' => $tgl);
        //$myObj = array('kode_aset' => $kode, 'nama_aset' => $nama);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

    if(isset($_POST['id_maintenance'])) {
        $id_maintenance = $_POST['id_maintenance'];
        $id_aset = $_POST['id_aset'];
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
        
        $query = mysqli_query($koneksi, "UPDATE pemeliharaan_aset SET TANGGAL_PEMELIHARAAN = '".$tgl_pemeliharaan."', SELESAI_PEMELIHARAAN = '".$tgl_selesai."', BIAYA_PEMELIHARAAN = '".$biaya."', HASIL_PEMELIHARAAN = '".$keterangan."', STATUS_PEMELIHARAAN = 'Selesai' WHERE ID_PEMELIHARAAN = '".$id_maintenance."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }

        //Buat next jadwal pemeliharaan
        $select_first = mysqli_query($koneksi, "SELECT * FROM pemeliharaan_aset WHERE ID_PEMELIHARAAN = '".$id_maintenance."'");
        $row_first = mysqli_fetch_array($select_first);
        $notif = $row_first['NOTIF'];
        $tgl_jadwal = $row_first['TANGGAL_PENJADWALAN'];
        $select = mysqli_query($koneksi, "SELECT * FROM pemeliharaan_berkala WHERE ID_ASET = '".$id_aset."'");
        //$get = mysqli_num_rows($select);
        if(mysqli_num_rows($select) == 1){
            $row = mysqli_fetch_array($select);
            if($row['PILIHAN'] == 'custom') {
                $frekuensi = $row['FREKUENSI'];
                $interval = $row['JARAK_INTERVAL'];
                if($frekuensi == 'Minggu'){
                    $day = $interval * 7;
                    $new_date = date('Y-m-d', strtotime($tgl_jadwal. ' +'.$day.' days'));
                }
                if($frekuensi == 'Bulan'){
                    $new_date = date('Y-m-d', strtotime($tgl_jadwal. ' +'.$interval.' months'));
                }
                if($frekuensi == 'Tahun'){
                    $new_date = date('Y-m-d', strtotime($tgl_jadwal. ' +'.$interval.' years'));
                }
            }
            if($row['PILIHAN'] == 'tahun'){
                $new_date = date('Y-m-d', strtotime($tgl_jadwal. ' +1 year'));
            }
            if($row['PILIHAN'] == 'bulan'){
                $new_date = date('Y-m-d', strtotime($tgl_jadwal. ' +1 month'));
            }
            if($row['PILIHAN'] == 'awal_bulan'){
                //$month = date('m',strtotime($tgl_jadwal));
                //$new_date = date('Y-'.$month.'-01', strtotime($tgl_jadwal. ' +1 month'));
                $new_date = date('Y-m-d', strtotime($tgl_jadwal. ' +1 month'));
            }
            if($row['PILIHAN'] == 'akhir_bulan'){
                $new_date = date('Y-m-t', strtotime($tgl_jadwal. ' +1 month'));
            }
            $random_id_new = randomID('pemeliharaan_aset', 'ID_PEMELIHARAAN', 10);
            ECHO "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, NOTIF, STATUS_PEMELIHARAAN) VALUES ('".$random_id_new."','".$id_aset."','".$new_date."',".$notif.",'Aktif') \n";
            $query_new = mysqli_query($koneksi, "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, NOTIF, STATUS_PEMELIHARAAN) VALUES ('".$random_id_new."','".$id_aset."','".$new_date."',".$notif.",'Aktif')");
            if(!$query_new){
                echo mysqli_error($koneksi);
            }
        }
    }

    if(isset($_POST['id_cancel'])) {
        $id_maintenance = $_POST['id_cancel'];
        
        echo "UPDATE pemeliharaan_aset SET STATUS_PEMELIHARAAN = 'Dihapus' WHERE ID_PEMELIHARAAN = '".$id_maintenance."'";
        $query = mysqli_query($koneksi, "UPDATE pemeliharaan_aset SET STATUS_PEMELIHARAAN = 'Dihapus' WHERE ID_PEMELIHARAAN = '".$id_maintenance."'");

        if(!$query) {
            echo mysqli_error($koneksi);
        }
        // jadwal berikutnya
        $select_first = mysqli_query($koneksi, "SELECT * FROM pemeliharaan_aset WHERE ID_PEMELIHARAAN = '".$id_maintenance."'");
        $fet_first = mysqli_fetch_array($select_first);
        $tgl_selesai = $fet_first['TANGGAL_PENJADWALAN'];
        $notif = $fet_first['NOTIF'];
        $select = mysqli_query($koneksi, "SELECT * FROM pemeliharaan_berkala WHERE ID_ASET = '".$fet_first['ID_ASET']."' AND STATUS_BERKALA = 'Aktif'");
        //$get = mysqli_num_rows($select);
        if(mysqli_num_rows($select) == 1){
            $row = mysqli_fetch_array($select);
            if($row['PILIHAN'] == 'custom') {
                $frekuensi = $row['FREKUENSI'];
                $interval = $row['JARAK_INTERVAL'];
                if($frekuensi == 'Minggu'){
                    $day = $interval * 7;
                    $new_date = date('Y-m-d', strtotime($tgl_selesai. ' +'.$day.' days'));
                }
                if($frekuensi == 'Bulan'){
                    $new_date = date('Y-m-d', strtotime($tgl_selesai. ' +'.$interval.' months'));
                }
                if($frekuensi == 'Tahun'){
                    $new_date = date('Y-m-d', strtotime($tgl_selesai. ' +'.$interval.' years'));
                }
            }
            if($row['PILIHAN'] == 'tahun'){
                $new_date = date('Y-m-d', strtotime($tgl_selesai. ' +1 year'));
            }
            if($row['PILIHAN'] == 'bulan'){
                $new_date = date('Y-m-d', strtotime($tgl_selesai. ' +1 month'));
            }
            if($row['PILIHAN'] == 'awal_bulan'){
                $month = date('Y-m',strtotime($tgl_selesai. ' +1 month'));
                $new_date = date($month.'-01');
            }
            if($row['PILIHAN'] == 'akhir_bulan'){
                $new_date = date('Y-m-t', strtotime($tgl_selesai. ' +1 month'));
            }
            $random_id_new = randomID('pemeliharaan_aset', 'ID_PEMELIHARAAN', 10);
            ECHO "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, NOTIF, STATUS_PEMELIHARAAN) VALUES ('".$random_id_new."','".$id_aset."','".$new_date."',".$notif.",'Aktif') \n";
            $query_new = mysqli_query($koneksi, "INSERT INTO pemeliharaan_aset (ID_PEMELIHARAAN, ID_ASET, TANGGAL_PENJADWALAN, NOTIF, STATUS_PEMELIHARAAN) VALUES ('".$random_id_new."','".$id_aset."','".$new_date."',".$notif.",'Aktif')");
            if(!$query_new){
                echo mysqli_error($koneksi);
            }
        }
    }

    if (isset($_POST['mati_jadwal'])) {
        $id = $_POST['mati_jadwal'];
        $query = mysqli_query($koneksi, "UPDATE pemeliharaan_berkala SET STATUS_BERKALA = 'Mati' WHERE ID_PENJADWALAN = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
    }
?>