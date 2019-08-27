<?php
    session_start();
    include "../connection.php";
    if($_POST['username'] == "" || $_POST['password'] == "") {
        header("location:../login/?no-input");
    }
    else {
        $myusername = mysqli_real_escape_string($koneksi, $_POST['username']);
        $mypassword = mysqli_real_escape_string($koneksi, $_POST['password']); 
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE USERNAME = '".$myusername."' AND PASSWORD = '".$mypassword."'");
        
        //$result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
        //$active = $row['active'];
        $count = mysqli_num_rows($query);

        // If result matched $myusername and $mypassword, table row must be 1 row        
        if($count == 1) {
            $date = date('Y-m-d H:i:s');
            $query = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG) VALUES ('".$row['ID_USER']."','".$date."', 'login')");
            $_SESSION['login_user'] = $myusername;
            $_SESSION['id_user'] = $row['ID_USER'];
            $_SESSION['nama_user'] = $row['NAMA_LENGKAP'];
            $_SESSION['username'] = $row['USERNAME'];
            $_SESSION['role'] = $row['ROLE'];
            $_SESSION['foto_user'] = $row['FOTO_USER'];
            $_SESSION['notif'] = true;
            header("location:../");
        }
        else {
            //echo $count;
            header("location:../login/?error");
        }
    }
?>