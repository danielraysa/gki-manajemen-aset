<?php
    session_start();
    if (!isset($_SESSION['login_user'])) {
        header("location:login/");
    }
    if(!isset($_SESSION["cart_item"])) {
		$_SESSION["cart_item"] = array();
    }
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
        <?php if($_SESSION['role'] == "Anggota MJ" || $_SESSION['role'] == "Ketua MJ") { ?>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                    <?php
                        $query = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM daftar_aset");
                        $fetch = mysqli_fetch_array($query);
                        echo $fetch['jumlah'];
                    ?></h3>

                        <p>Total Aset</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-television"></i>
                    </div>
                    <a href="aset/" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                    <?php
                        $query = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM peminjaman_aset WHERE HASIL_PENGAJUAN = 'Pending'");
                        $fetch = mysqli_fetch_array($query);
                        echo $fetch['jumlah'];
                    ?></h3>

                        <p>Pengajuan Peminjaman</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-question-circle"></i>
                    </div>
                    <a href="peminjaman/" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-6">

                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                    <?php
                        $query = mysqli_query($koneksi, "SELECT COUNT(d.ID_ASET) as jumlah FROM detail_peminjaman d JOIN peminjaman_aset p ON d.ID_PEMINJAMAN = p.ID_PEMINJAMAN WHERE p.HASIL_PENGAJUAN = 'Diterima' AND p.REALISASI_PENGEMBALIAN IS NULL");
                        $fetch = mysqli_fetch_array($query);
                        echo $fetch['jumlah'];
                    ?></h3>

                        <p>Aset Terpinjam</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <a href="peminjaman/" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                    <?php
                        $query = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM pemeliharaan_aset");
                        $fetch = mysqli_fetch_array($query);
                        echo $fetch['jumlah'];
                    ?></h3>

                        <p>Pemeliharaan Aset</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-gears"></i>
                    </div>
                    <a href="pemeliharaan/" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Info boxes -->
        <div class="row">
            <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Jumlah Aset per Tiap Ruangan</h3>
                    </div>
                    <div class="box-body">
                        <canvas id="myChart" height="400px"></canvas>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                    <form method="post" action="action.php">
                        <h3 class="box-title">Jumlah Aset Tiap Komisi Jemaat</h3>
                    </form>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <canvas id="myChartA" height="400px"></canvas>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
        </div>
        <?php 
        }
        else { ?>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Usulan Peminjaman</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Tgl Pakai</th>
                                    <th>Keterangan</th>
                                    <th>Status Pengajuan</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    //$query = mysqli_query($koneksi,"SELECT p.id_peminjaman, p.nama_peminjam, p.no_hp, p.keterangan_pinjam, p.tanggal_peminjaman, p.tanggal_pengajuan, p.hasil_pengajuan FROM peminjaman_aset p WHERE p.status_peminjaman = 'Aktif' AND p.tanggal_peminjaman <= NOW()");
                                    $query = mysqli_query($koneksi,"SELECT p.id_peminjaman, u.nama_lengkap, p.no_hp, p.keterangan_pinjam, p.tanggal_peminjaman, p.tanggal_pengajuan, p.hasil_pengajuan FROM peminjaman_aset p JOIN user u ON p.id_user = u.id_user WHERE p.status_peminjaman = 'Aktif' AND p.id_user = '".$_SESSION['id_user']."'");
                                    $a = 1;
                                    while($row = mysqli_fetch_array($query)) {
                                    ?>
                                <tr>
                                    <td><?php echo $a; ?></td>
                                    <td><?php echo $row['tanggal_pengajuan']; ?></td>
                                    <td><?php echo $row['tanggal_peminjaman']; ?></td>
                                    <td><?php echo $row['keterangan_pinjam']; ?></td>
                                    <td>
                                        <?php
                                            if($row['hasil_pengajuan'] == "Diterima") {
                                            ?>
                                        <button class="btn btn-success"><i class="fa fa-check"></i>
                                            <?php echo $row['hasil_pengajuan']; ?></button>
                                        <?php
                                            }
                                            if($row['hasil_pengajuan'] == "Ditolak") {
                                        ?>
                                        <button class="btn btn-danger"><i class="fa fa-close"></i>
                                            <?php echo $row['hasil_pengajuan']; ?></button>
                                        <?php
                                            }
                                            if($row['hasil_pengajuan'] == "Pending") {
                                        ?>
                                        <button class="btn btn-primary"><i class="fa fa-circle-o-notch fa-spin"></i>
                                            <?php echo $row['hasil_pengajuan']; ?></button>
                                        <?php
                                            }
                                        ?>
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
            </div>
        </div>
        <?php
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