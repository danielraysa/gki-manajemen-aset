<?php
	session_start();
    include "../connection.php";
    $date = date('Y-m-d H:i:s');
	$google_id = $_POST['id'];
    //$_POST['name'];
    //$_POST['email'];
    echo $_POST['gambar'];
    $url =  $_POST['gambar'];
    $imageFileType = pathinfo($url,PATHINFO_EXTENSION);
    $img = randomID('user','FOTO_USER', 10);
    $img_name = $img.".".$imageFileType;
    $dir = "../gambar/user"; // Full Path
    // get username based email
    $user = strstr($_POST['email'], '@', true);
    // Function to write image into file 
    //file_put_contents($img, file_get_contents($url));
    copy($url, $dir . DIRECTORY_SEPARATOR .$img_name);

	$load = mysqli_query($koneksi, "SELECT * FROM user WHERE EMAIL = '".$_POST['email']."'");
	
	if(mysqli_num_rows($load) != 0 ){
        //$query = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG) VALUES ('".$row['ID_USER']."','".$date."', 'login')");
        //$cek = mysqli_query($koneksi, "");
        $sql2 = "UPDATE user SET GOOGLE_ID = '".$google_id."' WHERE EMAIL = '".$_POST['email']."'";
        $query = mysqli_query($koneksi, $sql2);
    }
    else{
        $random_id = randomID('user', 'ID_USER', 10);
        $query = mysqli_query($koneksi, "INSERT INTO user (ID_USER, USERNAME, PASSWORD, NAMA_LENGKAP, GOOGLE_ID, EMAIL, ROLE, FOTO_USER, STATUS_USER) VALUES ('".$random_id."','".$user."','12345678','".$_POST['nama']."', '".$google_id."','".$_POST['email']."', 'Peminjam', '".$img_name."', 'Aktif')");
    }

    $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE EMAIL = '".$_POST['email']."'");
    $row = mysqli_fetch_array($sql);
    $ipAddress = get_client_ip();
    $query = mysqli_query($koneksi, "INSERT INTO log_akses (ID_USER, TANGGAL_LOG, ACTIVITY_LOG, ACTIVITY_DETAIL, IP_ADDRESS) VALUES ('".$row['ID_USER']."','".$date."', 'login','".$_SERVER['HTTP_USER_AGENT']."', '".$ipAddress."')");
	$_SESSION['login_user'] = $_POST['email'];
    $_SESSION['id_user'] = $row['ID_USER'];
    $_SESSION['nama_user'] = $row['NAMA_LENGKAP'];
    $_SESSION['username'] = $row['USERNAME'];
    $_SESSION['role'] = $row['ROLE'];
    $_SESSION['foto_user'] = $row['FOTO_USER'];
    $_SESSION['google_id'] = true;
    $_SESSION['notif'] = true;

	echo "Updated Successful";
?>