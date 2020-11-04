<?php
    session_start();
    
    if (!isset($_SESSION['login_user'])) {
        header("location:../index.php");
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
    
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Laporan 
      <?php
      if(isset($_GET['pengadaan'])) {
        echo "Pengadaan";
      }
      if(isset($_GET['peminjaman'])) {
        echo "Peminjaman";
      }
      if(isset($_GET['pemeliharaan'])) {
        echo "Pemeliharaan";
      }
      if(isset($_GET['penghapusan'])) {
        echo "Penghapusan";
      }
      ?> Aset
        <!-- <small>Sarana Prasarana</small> -->
      </h1>
      
    </section>
    <!-- Main content -->
    <section class="content">
    <?php
      if(isset($_GET['pengadaan'])) {
        include "pengadaan.php";
      }
      if(isset($_GET['peminjaman'])) {
        include "peminjaman.php";
      }
      if(isset($_GET['pemeliharaan'])) {
        include "pemeliharaan.php";
      }
      if(isset($_GET['penghapusan'])) {
        include "penghapusan.php";
      }
    ?>
    </section>

  </div>

    <?php include "../footer.php"; ?>
    </div>
    <?php include "js-script.php"; ?>
</body>
</html>