<?php
    session_start();
    setlocale (LC_TIME, 'INDONESIAN');
    date_default_timezone_set("Asia/Jakarta");
    if (!isset($_SESSION['login_user'])) {
        header("location:../index.php");
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
    ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pemeliharaan Aset
        <!-- <small>Sarana Prasarana</small> -->
      </h1>
      
    </section>
    <!-- Main content -->
    <section class="content">
    <?php
    if(isset($_GET['success'])) {
    ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Success adding new data. This alert is dismissable.
    </div>
    <?php
    }
    if(isset($_GET['edit'])) {
    ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Success editing data. This alert is dismissable.
    </div>
    <?php
    }
    if(isset($_GET['delete'])) {
    ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Success deleting data. This alert is dismissable.
    </div>
    <?php
    }
    if(isset($_GET['error'])) {
    ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-close"></i> Alert!</h4>
        <?php echo $_SESSION['error-msg']; ?>
    </div>
    <?php
    }
    ?>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Jadwal Pemeliharaan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover table-responsive" style="width: 100%">
              <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Aset</th>
                    <th>Nama Aset</th>
                    <th>Jadwal Pemeliharaan</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  //include('plugins/phpqrcode/qrlib.php');
                  $a = 1;
                  $date = date('Y-m-d');
                  //$query = mysqli_query($koneksi,"SELECT p.ID_ASET, d.KODE_ASET, d.NAMA_ASET, p.TANGGAL_PENJADWALAN, p.BATAS_PENJADWALAN FROM pemeliharaan_aset p JOIN daftar_aset d ON p.ID_ASET = d.ID_ASET WHERE p.TANGGAL_PENJADWALAN = (SELECT MIN(TANGGAL_PENJADWALAN) FROM pemeliharaan_aset WHERE p.ID_ASET = pemeliharaan_aset.ID_ASET) AND p.STATUS_PEMELIHARAAN = 'Aktif'");
                  $query = mysqli_query($koneksi,"SELECT p.ID_PEMELIHARAAN, p.ID_ASET, d.KODE_ASET, d.NAMA_ASET, MIN(p.TANGGAL_PENJADWALAN) as TANGGAL_PENJADWALAN, p.BATAS_PENJADWALAN FROM pemeliharaan_aset p LEFT OUTER JOIN daftar_aset d ON p.ID_ASET = d.ID_ASET WHERE p.STATUS_PEMELIHARAAN = 'Aktif' GROUP BY p.ID_ASET");
                  while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                      <td><?php echo $a; ?></td>
                      <td><?php echo $row['KODE_ASET']; ?></td>
                      <td><?php echo $row['NAMA_ASET']; ?></td>
                      <td><?php echo strftime("%d %B %Y", strtotime($row['TANGGAL_PENJADWALAN'])); ?></td>
                      <td><?php if($date<$row['TANGGAL_PENJADWALAN']) echo "Belum terlaksana"; else echo "Segera dilaksanakan"; ?></td>
                      <td>
                        <button type="button" data-toggle="modal" data-target="#modal-maintenance"  data-id="<?php echo $row['ID_PEMELIHARAAN']; ?>" class="btn btn-success modalMaintenance"><i class="fa fa-gear"></i> Pemeliharaan</button>
                        <button type="button" data-toggle="modal" data-target="#modal-delete"  data-id="<?php echo $row['ID_PEMELIHARAAN']; ?>" class="btn btn-danger modalDelete"><i class="fa fa-close"></i> Batalkan</button>
                        </td>
                    </tr>
                    <?php
                      $a++;
                      }
                    ?>
                </tbody>
              </table>
              <?php include "modal.php"; ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Penjadwalan Pemeliharaan Aset</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover table-responsive" style="width: 100%">
              <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Aset</th>
                    <th>Nama Aset</th>
                    <th>Merk</th>
                    <th>Ruangan</th>
                    <th>Komisi</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  //include('plugins/phpqrcode/qrlib.php');
                  $a = 1;
                  $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.KODE_ASET, d.NAMA_ASET, m.NAMA_MERK, d.HARGA_PEMBELIAN, d.TANGGAL_PEMBELIAN, r.NAMA_RUANGAN, k.NAMA_KOMISI, d.MASA_MANFAAT, d.STATUS_ASET FROM daftar_aset d JOIN merk m ON d.ID_MERK = m.ID_MERK JOIN ruangan r ON d.ID_RUANGAN = r.ID_RUANGAN JOIN komisi_jemaat k ON d.ID_KOMISI = k.ID_KOMISI WHERE d.STATUS_ASET = 'Aktif'");
                  while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                      <td><?php echo $a; ?></td>
                      <td><?php echo $row['KODE_ASET']; ?></td>
                      <td><?php echo $row['NAMA_ASET']; ?></td>
                      <td><?php echo $row['NAMA_MERK']; ?></td>
                      <td><?php echo $row['NAMA_RUANGAN']; ?></td>
                      <td><?php echo $row['NAMA_KOMISI']; ?></td>
                      <td><?php echo $row['STATUS_ASET']; ?></td>
                      <td><button type="button" data-toggle="modal" data-target="#modal-jadwal" data-id="<?php echo $row['ID_ASET']; ?>"  class="btn btn-warning modalJadwal"><i class="fa fa-calendar-check-o"></i> Jadwalkan</button></td>
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
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
    <?php include "../footer.php"; ?>
    <?php include "../control-sidebar.php"; ?>
    </div>
    <?php include "js-script.php"; ?>
</body>
</html>