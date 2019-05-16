<?php
    session_start();
    if (!isset($_SESSION['login_user'])) {
      header("location:../index.php");
    }
    if(!isset($_SESSION['item_pinjam'])) {
      $_SESSION['item_pinjam'] = array();
    }
    $dir = basename(__DIR__);
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "css-script.php"; ?>
    <?php include "../connection.php"; ?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
    <?php
      include "header.php";
      include "main-sidebar.php";
      if($_SESSION['role'] == "Peminjam") {
        include "content1.php";
      }
      if($_SESSION['role'] == "Anggota MJ") {
        include "approval.php";
      }
    ?>
    
    <?php include "../footer.php"; ?>
    <?php include "../control-sidebar.php"; ?>
    </div>
    <?php include "js-script.php"; ?>
</body>
</html>