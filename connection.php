<?php
    
    setlocale(LC_NUMERIC, 'INDONESIA');
    setlocale(LC_TIME, 'INDONESIAN');
    date_default_timezone_set("Asia/Jakarta");
    $log_date = date('Y-m-d');
    error_reporting(E_ERROR | E_WARNING);
    ini_set("log_errors", 1);
    ini_set("error_log", __DIR__."/errors/error-$log_date.log");
    // ini_set('display_errors', 1); 
    // ini_set('display_startup_errors', 1); 
    $root_folder = basename(__DIR__);
    
    $koneksi = mysqli_connect("trialscode.my.id","daniel","anel2204","gki_aset");
    
    function randString($length) {
        $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
        }
        return $str;
    }

    function loadKonfigurasi($input) {
        global $koneksi;
        $query = mysqli_query($koneksi,"SELECT ".$input." as hasil FROM konfigurasi");
        $row = mysqli_fetch_array($query);
        return $row['hasil'];
    }

    function randomID($table, $id_table, $char) {
        global $koneksi;
        $is_unique = false;
        while (!$is_unique) {
            $random_id = randString($char);
            $query = mysqli_query($koneksi,"SELECT * FROM ".$table." WHERE ".$id_table." = '".$random_id."'");
            if (mysqli_num_rows($query) == 0) {  
                // if you don't get a result, then you're good
                $is_unique = true;
                return $random_id;
            }
        }
    }

    function asRupiah($value) {
        //return 'Rp. ' . number_format($value);
        return 'Rp. ' . str_replace(',','.',number_format($value));
    }

    function tglIndo($date) {
        $tgl = strftime("%d %B %Y", strtotime($date));
        return $tgl;
    }

    function tglIndo_day($date) {
        $tgl = strftime("%A, %d %B %Y", strtotime($date));
        return $tgl;
    }

    function tglIndo_full($date) {
        $tgl = strftime("%d %B %Y %H:%M:%S", strtotime($date));
        return $tgl;
    }
    
    if(isset($_SESSION['id_user'])) {
        $info = mysqli_query($koneksi, "SELECT * FROM user WHERE ID_USER = '".$_SESSION['id_user']."'");
        $row = mysqli_fetch_array($info);
        if($_SESSION['nama_user'] != $row['NAMA_LENGKAP']) {
            $_SESSION['nama_user'] = $row['NAMA_LENGKAP'];
        }
        if($_SESSION['foto_user'] != $row['FOTO_USER']) {
            if(substr($row['FOTO_USER'], 0, 4) == "http") {
                $_SESSION['foto_user'] = $row['FOTO_USER'];
            } else {
                if($row['FOTO_USER'] == "") $_SESSION['foto_user'] = "gambar/user/user2-160x160.jpg"; else $_SESSION['foto_user'] = "gambar/user/".$row['FOTO_USER'];
            }
        }
    }

    // Function to get the client IP address
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /* function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    } */
?>