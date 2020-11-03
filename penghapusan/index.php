<?php
    session_start();
    setlocale (LC_TIME, 'INDONESIAN');
    setlocale(LC_NUMERIC, 'INDONESIA');
    date_default_timezone_set("Asia/Jakarta");
    
    if (!isset($_SESSION['login_user'])) {
        header("location:../index.php");
    }
    if(!isset($_SESSION['temp_hapus'])) {
      $_SESSION['temp_hapus'] = array();
    }
    $dir = basename(__DIR__);
?>

<!DOCTYPE html>
<html>
<head>
    <?php include "../connection.php"; ?>
    <?php include "../css-script.php"; ?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
    <?php
        include "../header.php";
        include "../main-sidebar.php";
        if($_SESSION['role'] == "Anggota MJ") {
          include "content.php";
        }
        if($_SESSION['role'] == "Ketua MJ") {
          include "approval.php";
        }
    ?>

  <!-- /.content-wrapper -->
    <?php include "../footer.php"; ?>
    <?php include "../control-sidebar.php"; ?>
    </div>
    <?php include "modal.php"; ?>
    <?php include "js-script.php"; ?>
</body>
</html>