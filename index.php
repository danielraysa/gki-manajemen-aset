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
    <?php include "connection.php"; ?>
    <?php include "css-script.php"; ?>
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
        <div class="modal fade" id="modal-list">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="modal_list"></h4>
                    </div>
                    <div class="modal-body">
                        <table id="example4" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Aset</th>
                                <th>Nama Aset</th>
                                <th>Jenis Barang</th>
                            </tr>
                            </thead>
                        </table>     
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-detail">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Daftar Aset yang Dipinjam</h4>
                    </div>
                    <div class="modal-body">
                        <table id="example3" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Aset</th>
                                <th>Jenis Barang</th>
                            </tr>
                            </thead>
                        </table>     
                    </div>
                    
                </div>
            </div>
        </div>
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