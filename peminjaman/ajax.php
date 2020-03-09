<?php
    session_start();
    
    //include "../sms-config.php";
    include "../connection.php";
    require_once('../vendor/autoload.php');

    use SMSGatewayMe\Client\ApiClient;
    use SMSGatewayMe\Client\Configuration;
    use SMSGatewayMe\Client\Api\MessageApi;
    use SMSGatewayMe\Client\Model\SendMessageRequest;

    // Update the path below to your autoload.php,
    // see https://getcomposer.org/doc/01-basic-usage.md
    use Twilio\Rest\Client;
    
    // Find your Account Sid and Auth Token at twilio.com/console
    // DANGER! This is insecure. See http://twil.io/secure
    $sid    = "AC11c4a6659b166118f38b4c28767ed8c3";
    $token  = "fa8e8ee787be28cc1b1e28f457590a38";
    // $twilio = new Client($sid, $token);
    //new number +12019480809
    //"from" => "whatsapp:+14155238886",
    /* $message = $twilio->messages
                        ->create("whatsapp:+6282230143314", // to
                                array(
                                    "from" => "whatsapp:+6289624762088",
                                    "body" => "Hello there! This is Twilio API"
                                )
                        );
    
    print($message->sid); */

    // Configure client
    $config = Configuration::getDefaultConfiguration();
    $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU1NjIyMDUyMywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjYzMjA3LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.TxSPGIZqTbeKu_vcN0jGdX04eZ0DoTt-dhn1fwI82jc');
    $apiClient = new ApiClient($config);
    $messageClient = new MessageApi($apiClient);
    $deviceId = 115993;
    //$deviceId = 104188;
    if(isset($_POST['empty'])){
        unset($_SESSION['item_pinjam']);
    }

    if(isset($_POST['add-pinjam'])) {
        $id = $_POST['add-pinjam'];
        $query = mysqli_query($koneksi,"SELECT * FROM daftar_baru WHERE ID_BARANG = '".$id."'");
        $fet = mysqli_fetch_array($query);
        $kode_aset = $fet['KODE_BARANG'];
        $nama_aset = $fet['NAMA_BARANG'];
        $nama_barang = $fet['JENIS'];
        
        $add = array('id_aset' => $id, 'kode_aset' => $kode_aset, 'nama_aset' => $nama_aset, 'barang' => $nama_barang);
        array_push($_SESSION['item_pinjam'], $add);
        $myJSON = json_encode($_SESSION['item_pinjam']);
        echo $myJSON;
    }

    if(isset($_POST['hapus_item'])) {
        $val = $_POST['hapus_item'];
        //echo search_array($val);
        $key_index = array_search($val, array_column($_SESSION['item_pinjam'], 'id_aset'));
        array_splice($_SESSION['item_pinjam'], $key_index, 1);
    }

    if(isset($_POST['simpan_pinjam'])){
        //$id_user = $_POST['id_peminjam'];
        $id_user = $_SESSION['id_user'];
        $id_komisi = $_POST['id_komisi'];
        $no_hp = $_POST['no_hp'];
        $tgl = $_POST['tgl_pinjam'];
        $tgl2 = $_POST['tgl_kembali'];
        $keterangan = $_POST['keterangan'];
        $date = str_replace('/', '-', $tgl);
        $date2 = str_replace('/', '-', $tgl2);
        echo $date."\n";
        $tgl_awal = date("Y-m-d", strtotime($date)); // $tgl_awal = date("Y-m-d", strtotime(substr($date,0,10)));
        echo $tgl_awal."\n";
        $tgl_akhir = date("Y-m-d", strtotime($date2)); // $tgl_akhir = date("Y-m-d", strtotime(substr($date,13)));
        echo $tgl_akhir."\n";
        $date_now = date('Y-m-d H:i:s');
        //$random_id = randString(10);
        $random_id = randomID('peminjaman_aset', 'ID_PEMINJAMAN', 10);
        $_SESSION['print_id'] = $random_id;
        echo "INSERT INTO peminjaman_aset (ID_PEMINJAMAN, ID_USER, ID_KOMISI, KETERANGAN_PINJAM, NO_HP, HASIL_PENGAJUAN, TANGGAL_PENGAJUAN, TANGGAL_PEMINJAMAN, TANGGAL_PENGEMBALIAN, STATUS_PEMINJAMAN) VALUES ('".$random_id."','".$id_user."','".$id_komisi."','".$keterangan."','".$no_hp."','Pending','".$date_now."','".$tgl_awal."','".$tgl_akhir."','Aktif') \n";
        $query = mysqli_query($koneksi, "INSERT INTO peminjaman_aset (ID_PEMINJAMAN, ID_USER, ID_KOMISI, NO_HP, KETERANGAN_PINJAM, HASIL_PENGAJUAN, TANGGAL_PENGAJUAN, TANGGAL_PEMINJAMAN, TANGGAL_PENGEMBALIAN, STATUS_PEMINJAMAN) VALUES ('".$random_id."','".$id_user."','".$id_komisi."','".$no_hp."','".$keterangan."','Pending','".$date_now."','".$tgl_awal."','".$tgl_akhir."','Aktif')");
        $log = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG, ID_REF, ACTIVITY_DETAIL) VALUES ('".$_SESSION['id_user']."','".$date_now."', 'peminjaman', '".$random_id."','pengajuan_peminjaman')");
        if(!$query) {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            echo $_SESSION['error-msg'];
        }

        foreach($_SESSION['item_pinjam'] as $select => $value){
            //$random_id_item = randString(10);
            $random_id_item = randomID('detail_peminjaman', 'ID_DETIL_PINJAM', '10');
            echo "INSERT INTO detail_peminjaman (ID_DETIL_PINJAM, ID_PEMINJAMAN, ID_ASET) VALUES ('".$random_id_item."','".$random_id."','".$value['id_aset']."') \n";
            $insert = mysqli_query($koneksi, "INSERT INTO detail_peminjaman (ID_DETIL_PINJAM, ID_PEMINJAMAN, ID_ASET) VALUES ('".$random_id_item."','".$random_id."','".$value['id_aset']."')");
        }
        unset($_SESSION['item_pinjam']);

        $sendMessageRequest = new SendMessageRequest([
            'phoneNumber' => $no_hp, 'message' => 'Pengajuan peminjaman pada '.$date_now.' dengan ID '.$random_id.' berhasil disimpan. (TEST_NOREPLY)', 'deviceId' => $deviceId
        ]);
        $sentMessages = $messageClient->sendMessages([$sendMessageRequest]);
        /* if($sentMessages){
            print_r($sentMessages); 
        } */
        // buat print
        //$_SESSION['print_id'] = $random_id;
        //echo $random_id;
    }

    if (isset($_POST['usulan_pinjam'])) {
        $id = $_POST['usulan_pinjam'];
        $myObj = array();
        $a = 1;
        $query = mysqli_query($koneksi, "SELECT p.id_detil_pinjam, a.nama_aset, b.nama_barang FROM detail_peminjaman p JOIN daftar_aset a ON p.id_aset = a.id_aset JOIN detil_usulan_pengadaan pd ON a.id_usulan_tambah = pd.id_usulan_tambah JOIN barang b ON pd.id_barang = b.id_barang WHERE p.id_peminjaman = '".$id."'");
        while($row = mysqli_fetch_array($query)){
            $nama = $row['nama_aset'];
            $barang = $row['nama_barang'];
            $id_item = $row['id_detil_pinjam'];
            
            $array = array($a, $nama, $barang);
            array_push($myObj, $array);
            $a++;
        }
        //$myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga, 'keterangan' => $keterangan);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

    if (isset($_POST['usulan_pinjam_cek'])) {
        $id = $_POST['usulan_pinjam_cek'];
        $myObj = array();
        $a = 1;
        $query = mysqli_query($koneksi, "SELECT p.id_detil_pinjam, (SELECT COUNT(x.ID_ASET) FROM detail_peminjaman x JOIN peminjaman_aset z ON x.ID_PEMINJAMAN = z.ID_PEMINJAMAN WHERE x.ID_ASET = p.ID_ASET AND z.HASIL_PENGAJUAN = 'Diterima' AND (z.TANGGAL_PENGEMBALIAN BETWEEN (SELECT TANGGAL_PEMINJAMAN FROM peminjaman_aset WHERE ID_PEMINJAMAN = '".$id."') AND (SELECT TANGGAL_PENGEMBALIAN FROM peminjaman_aset WHERE ID_PEMINJAMAN = '".$id."'))) as stat, p.ID_ASET, a.nama_aset, b.nama_barang FROM detail_peminjaman p JOIN daftar_aset a ON p.id_aset = a.id_aset JOIN detil_usulan_pengadaan pd ON a.id_usulan_tambah = pd.id_usulan_tambah JOIN barang b ON pd.id_barang = b.id_barang WHERE p.id_peminjaman = '".$id."'");
        while($row = mysqli_fetch_array($query)){
            $nama = $row['nama_aset'];
            $barang = $row['nama_barang'];
            $id_item = $row['id_detil_pinjam'];
            if($row['stat'] > 0){
                $status = "<b>Dipesan/dipakai</b>";
            }
            else {
                $status = "Tersedia";
            }
            $array = array($a, $nama, $barang, $status);
            array_push($myObj, $array);
            $a++;
        }
        //$myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga, 'keterangan' => $keterangan);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

    // approve pengadaan
    if (isset($_GET['approve'])) {
        $id = $_GET['approve'];
        $date = date('Y-m-d H:i:s');
        $query = mysqli_query($koneksi, "UPDATE peminjaman_aset SET HASIL_PENGAJUAN = 'Diterima' WHERE ID_PEMINJAMAN = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
        $insert = mysqli_query($koneksi, "INSERT INTO notifikasi(TABEL_REF, ID_REF, TGL_NOTIF, READ_NOTIF) VALUES ('peminjaman_aset', '".$id."', '".$date."', 0)");
        $select = mysqli_query($koneksi, "SELECT * FROM peminjaman_aset WHERE ID_PEMINJAMAN = '".$id."'");
        $row = mysqli_fetch_array($select);
        $log = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG, ID_REF, ACTIVITY_DETAIL) VALUES ('".$_SESSION['id_user']."','".$date."', 'peminjaman', '".$id."','terima_peminjaman')");
        $sendMessageRequest = new SendMessageRequest([
            'phoneNumber' => $row['NO_HP'], 'message' => 'Pengajuan peminjaman pada '.$row['TANGGAL_PENGAJUAN'].' telah diterima.', 'deviceId' => $deviceId
        ]);
        $sentMessages = $messageClient->sendMessages([$sendMessageRequest]);
        if($sentMessages){
            print_r($sentMessages); 
        }
    }

    if (isset($_GET['reject'])) {
        $id = $_GET['reject'];
        $date = date('Y-m-d H:i:s');
        $query = mysqli_query($koneksi, "UPDATE peminjaman_aset SET HASIL_PENGAJUAN = 'Ditolak' WHERE ID_PEMINJAMAN = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
        $insert = mysqli_query($koneksi, "INSERT INTO notifikasi(TABEL_REF, ID_REF, TGL_NOTIF, READ_NOTIF) VALUES ('peminjaman_aset', '".$id."', '".$date."', 0)");
        $select = mysqli_query($koneksi, "SELECT * FROM peminjaman_aset WHERE ID_PEMINJAMAN = '".$id."'");
        $row = mysqli_fetch_array($select);
        $log = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG, ID_REF, ACTIVITY_DETAIL) VALUES ('".$_SESSION['id_user']."','".$date."', 'peminjaman', '".$id."','tolak_peminjaman')");
        $sendMessageRequest = new SendMessageRequest([
            'phoneNumber' => $row['NO_HP'], 'message' => 'Pengajuan peminjaman pada '.$row['TANGGAL_PENGAJUAN'].' ditolak.', 'deviceId' => $deviceId
        ]);
        $sentMessages = $messageClient->sendMessages([$sendMessageRequest]);
        if($sentMessages){
            print_r($sentMessages); 
        }
    }

    if (isset($_POST['delete-usulan'])) {
        $id = $_POST['delete-usulan'];
        $date = date('Y-m-d H:i:s');
        $query = mysqli_query($koneksi, "UPDATE peminjaman_aset SET HASIL_PENGAJUAN = 'Dihapus' WHERE ID_PEMINJAMAN = '".$id."'");
        if(!$query) {
            echo mysqli_error($koneksi);
        }
        else {
            echo "Success";
        }
        $log = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG, ID_REF, ACTIVITY_DETAIL) VALUES ('".$_SESSION['id_user']."','".$date."', 'peminjaman', '".$id."','hapus_pengajuan')");
    }

    if(isset($_POST['cek_pinjam'])) {
        $id = $_POST['cek_pinjam'];
        $query = mysqli_query($koneksi, "SELECT * FROM peminjaman_aset WHERE ID_PEMINJAMAN = '".$id."'");
        $row = mysqli_fetch_array($query);
        $newDate = date("d/m/Y", strtotime($row['TANGGAL_PENGEMBALIAN']));
        //echo $newDate;
        //$id = $_POST['usulan_pinjam'];
        $myObj = array();
        $myObj_tem = array();
        $a = 1;
        $query = mysqli_query($koneksi, "SELECT p.id_detil_pinjam, a.nama_aset, b.nama_barang FROM detail_peminjaman p JOIN daftar_aset a ON p.id_aset = a.id_aset JOIN detil_usulan_pengadaan pd ON a.id_usulan_tambah = pd.id_usulan_tambah JOIN barang b ON pd.id_barang = b.id_barang WHERE p.id_peminjaman = '".$id."'");
        while($row = mysqli_fetch_array($query)){
            $nama = $row['nama_aset'];
            $barang = $row['nama_barang'];
            $id_item = $row['id_detil_pinjam'];
            $array = array($a, $nama, $barang, "<input type='text' class='form-control' name='catatan[]'> <input type='hidden' value='$id_item' name='detil_item[]'> ");
            array_push($myObj_tem, $array);
            $a++;
        }
        $myObj = array('tgl_kembali' => $newDate, 'items' => $myObj_tem);
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

    if(isset($_POST['kembali'])) {
        $now = date('Y-m-d H:i:s');
        $id = $_POST['kembali'];
        //$catatan = $_POST['catatan'];
        $arr_catatan = explode("|",$_POST['catatan']);
        $arr_item = explode("|",$_POST['item_detil']);
        $tgl = $_POST['realisasi_pengembalian'];
        $keterangan = $_POST['keterangan'];
        $date = str_replace('/', '-', $tgl);
        echo $date."\n";
        $tgl_kembali = date("Y-m-d", strtotime(substr($date,0,10)));
        echo $tgl_kembali."\n";
        //$query = mysqli_query($koneksi, "UPDATE peminjaman_aset SET KETERANGAN_PENGEMBALIAN = '".$keterangan."', REALISASI_PENGEMBALIAN = '".$tgl_kembali."' WHERE ID_PEMINJAMAN = '".$id."'");
        $query = mysqli_query($koneksi, "UPDATE peminjaman_aset SET REALISASI_PENGEMBALIAN = '".$tgl_kembali."' WHERE ID_PEMINJAMAN = '".$id."'");
        $log = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG, ID_REF, ACTIVITY_DETAIL) VALUES ('".$_SESSION['id_user']."','".$now."', 'peminjaman', '".$id."','pengembalian')");
        for($a = 0; $a < count($arr_catatan); $a++){
            //$query2 = mysqli_query($koneksi, "UPDATE detail_peminjaman SET CATATAN = '".$keterangan."' WHERE ID_PEMINJAMAN = '".$id."'");
            $query2 = mysqli_query($koneksi, "UPDATE detail_peminjaman SET CATATAN = '".$arr_catatan[$a]."' WHERE ID_DETIL_PINJAM = '".$arr_item[$a]."'");
        }
    }

    if(isset($_POST['sms_reminder'])){
        $id = $_POST['id_peminjaman'];
        $select = mysqli_query($koneksi, "SELECT * FROM peminjaman_aset WHERE ID_PEMINJAMAN = '".$id."'");
        $row = mysqli_fetch_array($select);
        $sendMessageRequest = new SendMessageRequest([
            'phoneNumber' => $row['NO_HP'], 'message' => 'Peminjaman tgl '.$row['TANGGAL_PENGAJUAN'].' berakhir pada '.$row['TANGGAL_PENGEMBALIAN'].'. Harap segera dikembalikan tepat waktu. NOREPLY', 'deviceId' => $deviceId
        ]);
        $sentMessages = $messageClient->sendMessages([$sendMessageRequest]);
    }

    if(isset($_POST['wa_reminder'])){
        $id = $_POST['id_peminjaman'];
        $select = mysqli_query($koneksi, "SELECT * FROM peminjaman_aset WHERE ID_PEMINJAMAN = '".$id."'");
        $row = mysqli_fetch_array($select);
        $twilio = new Client($sid, $token);
        $message = $twilio->messages
                        ->create("whatsapp:+6289624762088", // to
                                array(
                                    "from" => "whatsapp:+12019480809",
                                    "body" => "Hello there! This is Twilio API"
                                )
                        );
        print($message->sid);
    }

    if(isset($_POST['update_pinjam'])){
        $id_peminjaman = $_POST['id_peminjaman'];
        $id_user = $_SESSION['id_user'];
        $id_komisi = $_POST['id_komisi'];
        $no_hp = $_POST['no_hp'];
        $tgl = $_POST['tgl_peminjaman'];
        $keterangan = $_POST['keterangan'];
        $date = str_replace('/', '-', $tgl);
        echo $date."\n";
        $tgl_awal = date("Y-m-d", strtotime(substr($date,0,10)));
        echo $tgl_awal."\n";
        $tgl_akhir = date("Y-m-d", strtotime(substr($date,13)));
        echo $tgl_akhir."\n";
        $date_now = date('Y-m-d H:i:s');
        //$random_id = randString(10);
        $_SESSION['print_id'] = $id_peminjaman;
        
        echo "UPDATE peminjaman_aset SET ID_USER = '".$id_user."', ID_KOMISI = '".$id_komisi."', KETERANGAN_PINJAM = '".$keterangan."', NO_HP = '".$no_hp."', TANGGAL_PEMINJAMAN = '".$tgl_awal."', TANGGAL_PENGEMBALIAN = '".$tgl_akhir."' WHERE ID_PEMINJAMAN = '".$id_peminjaman."' \n";
        $query = mysqli_query($koneksi, "UPDATE peminjaman_aset SET ID_USER = '".$id_user."', ID_KOMISI = '".$id_komisi."', KETERANGAN_PINJAM = '".$keterangan."', NO_HP = '".$no_hp."', TANGGAL_PEMINJAMAN = '".$tgl_awal."', TANGGAL_PENGEMBALIAN = '".$tgl_akhir."' WHERE ID_PEMINJAMAN = '".$id_peminjaman."'");
        if(!$query) {
            $_SESSION['error-msg'] = mysqli_error($koneksi);
            echo $_SESSION['error-msg'];
        }
        $delete = mysqli_query($koneksi, "DELETE FROM detail_peminjaman WHERE ID_PEMINJAMAN = '".$id_peminjaman."'");
        foreach($_SESSION['item_pinjam'] as $select => $value){
            //$random_id_item = randString(10);
            $random_id_item = randomID('detail_peminjaman', 'ID_DETIL_PINJAM', '10');
            echo "INSERT INTO detail_peminjaman (ID_DETIL_PINJAM, ID_PEMINJAMAN, ID_ASET) VALUES ('".$random_id_item."','".$id_peminjaman."','".$value['id_aset']."') \n";
            $insert = mysqli_query($koneksi, "INSERT INTO detail_peminjaman (ID_DETIL_PINJAM, ID_PEMINJAMAN, ID_ASET) VALUES ('".$random_id_item."','".$id_peminjaman."','".$value['id_aset']."')");
        }
        $log = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG, ID_REF, ACTIVITY_DETAIL) VALUES ('".$_SESSION['id_user']."','".$date_now."', 'peminjaman', '".$id_peminjaman."','ubah_pengajuan')");
        unset($_SESSION['item_pinjam']);

    }
?>