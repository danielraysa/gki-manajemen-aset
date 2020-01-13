<?php
    session_start();
    if (!isset($_SESSION['login_user'])) {
        header("location:../index.php");
    }
    
    setlocale(LC_NUMERIC, 'INDONESIA');
    
    $dir = basename(__DIR__);
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "../connection.php"; ?>
    <?php include "css-script.php"; ?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
    <?php
        include "../header.php";
        include "../main-sidebar.php";
    ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Log
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
          <div class="box-header">
              <h3 class="box-title">Histori Log</h3>
          </div>
          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover table-responsive" style="width: 100%;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>User</th>
                        <th>Activity</th>
                        <th>Detail</th>
                        <th>Reference</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //$query = mysqli_query($koneksi,"SELECT p.id_pengadaan, p.keterangan_usulan, p.tanggal_usulan, p.tanggal_modifikasi, p.hasil_approval FROM pengadaan_usul p WHERE p.status_usulan = 'Aktif'");
                        $query = mysqli_query($koneksi,"SELECT la.ID_LOG, la.TANGGAL_LOG, u.NAMA_LENGKAP, la.ACTIVITY_LOG, la.ACTIVITY_DETAIL FROM log_akses la JOIN user u ON la.ID_USER = u.ID_USER");
                        $a = 1;
                        while($row = mysqli_fetch_array($query)) {
                        ?>
                    <tr>
                        <td><?php echo $a; ?></td>
                        <td><?php echo tglIndo_full($row['TANGGAL_LOG']); ?></td>
                        <td><?php echo $row['NAMA_LENGKAP']; ?></td>
                        <td><?php echo $row['ACTIVITY_LOG']; ?></td>
                        <td><?php echo $row['ACTIVITY_DETAIL']; ?></td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#modal-maintenance"  data-id="<?php echo $row['ID_LOG']; ?>" class="btn btn-success modalMaintenance"><i class="fa fa-gear"></i> Cek</button>
                        </td>
                    </tr>
                    <?php
                        $a++;
                        }
                    ?>
                </tbody>
                
            </table>
          </div>
      </div>
        
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <?php include "../footer.php"; ?>
    <?php include "../control-sidebar.php"; ?>
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