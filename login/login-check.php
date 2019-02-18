<?php
    session_start();
    if($_POST['username'] == "" || $_POST['password'] == "") {
        header("location:../login/?no-input");
    }
        else {
        $koneksi = mysqli_connect("localhost","root","","gki_sarpras");
        $myusername = mysqli_real_escape_string($koneksi, $_POST['username']);
        $mypassword = mysqli_real_escape_string($koneksi, $_POST['password']); 
        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '".$myusername."' AND password = '".$mypassword."'");
        
        //$result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
        //$active = $row['active'];
        
        $count = mysqli_num_rows($query);
        
        // If result matched $myusername and $mypassword, table row must be 1 row
        
        if($count == 1) {
            $_SESSION['login_user'] = $myusername;
            $_SESSION['id_user'] = $row['id'];
            $_SESSION['success_login'] = 1;
            header("location:../");
        }
        else {
            //echo $count;
            header("location:../login/?error");
        }
    }
?>