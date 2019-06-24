<?php
    session_start();
    if (!isset($_SESSION['login_user'])) {
        header("location:login/");
    }
    /* if(!isset($_SESSION["cart_item"])) {
		$_SESSION["cart_item"] = array();
    } */
    setlocale (LC_TIME, 'INDONESIAN');
    $dir = basename(__DIR__);
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "css-script.php"; ?>
    <?php include "connection.php"; ?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
    <?php
        include "header.php";
        include "main-sidebar.php";
    ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php if($_SESSION['role'] == "Anggota MJ") {
            include "anggota.php";
        }
        else if($_SESSION['role'] == "Ketua MJ") {
            include "ketua.php";
        }
        else {
            include "peminjam.php";
        }
        ?>
        <!-- /.row -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
    <?php include "footer.php"; ?>
    <?php include "control-sidebar.php"; ?>
    </div>
    <?php include "js-script.php"; ?>
    <?php
    if (isset($_SESSION['success_login'])) {
        unset($_SESSION['success_login']);
    ?>
    <script>
    const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
    });

    toast({
    type: 'success',
    title: 'Signed in successfully'
    })
    </script>
    <?php
    }
    ?>
    
</body>
</html>