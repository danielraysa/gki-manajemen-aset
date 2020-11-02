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
        <h4><i class="icon fa fa-check"></i> Sukses!</h4>
        Berhasil menambahkan data baru.
    </div>
    <?php
    }
    if(isset($_GET['edit'])) {
    ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-pencil"></i> Sukses!</h4>
        Berhasil mengubah data.
    </div>
    <?php
    }
    if(isset($_GET['delete'])) {
    ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-trash"></i> Sukses!</h4>
        Berhasil menghapus data.
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
                  $query = mysqli_query($koneksi,"SELECT p.ID_PEMELIHARAAN, d.NAMA_BARANG, d.KODE_BARANG, p.TANGGAL_PENJADWALAN FROM pemeliharaan_aset p JOIN daftar_baru d ON p.ID_ASET = d.ID_ASET WHERE p.TANGGAL_PENJADWALAN IN (SELECT MIN(TANGGAL_PENJADWALAN) FROM pemeliharaan_aset WHERE STATUS_PEMELIHARAAN = 'Aktif' GROUP BY ID_ASET) AND p.ID_ASET IN (SELECT ID_ASET FROM pemeliharaan_aset WHERE STATUS_PEMELIHARAAN = 'Aktif' GROUP BY ID_ASET ORDER BY TANGGAL_PENJADWALAN) AND p.STATUS_PEMELIHARAAN = 'Aktif' ORDER BY p.TANGGAL_PENJADWALAN");
                  // $query = mysqli_query($koneksi,"SELECT p.ID_PEMELIHARAAN, d.NAMA_ASET, d.KODE_ASET, p.TANGGAL_PENJADWALAN FROM pemeliharaan_aset p JOIN daftar_aset d ON p.ID_ASET = d.ID_ASET WHERE p.TANGGAL_PENJADWALAN IN (SELECT MIN(TANGGAL_PENJADWALAN) FROM pemeliharaan_aset WHERE STATUS_PEMELIHARAAN = 'Aktif' GROUP BY ID_ASET) AND p.ID_ASET IN (SELECT ID_ASET FROM pemeliharaan_aset WHERE STATUS_PEMELIHARAAN = 'Aktif' GROUP BY ID_ASET ORDER BY TANGGAL_PENJADWALAN) AND p.STATUS_PEMELIHARAAN = 'Aktif' ORDER BY p.TANGGAL_PENJADWALAN");
                  //$query = mysqli_query($koneksi,"SELECT p.ID_PEMELIHARAAN, d.NAMA_ASET, d.KODE_ASET, p.TANGGAL_PENJADWALAN FROM pemeliharaan_aset p JOIN daftar_aset d ON p.ID_ASET = d.ID_ASET WHERE p.TANGGAL_PENJADWALAN IN (SELECT MIN(TANGGAL_PENJADWALAN) FROM pemeliharaan_aset WHERE STATUS_PEMELIHARAAN = 'Aktif' GROUP BY ID_ASET)");
                  while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                      <td><?php echo $a; ?></td>
                      <td><?php echo $row['KODE_BARANG']; ?></td>
                      <td><?php echo $row['NAMA_BARANG']; ?></td>
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
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Penjadwalan Pemeliharaan Aset</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover table-responsive" style="width: 100%">
              <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Aset</th>
                    <th>Nama Aset</th>
                    <th>Ruangan</th>
                    <th>Komisi</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  //include('plugins/phpqrcode/qrlib.php');
                  $a = 1;
                  // $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.KODE_ASET, d.NAMA_ASET, m.NAMA_MERK, d.HARGA_PEMBELIAN, d.TANGGAL_PEMBELIAN, r.NAMA_RUANGAN, k.NAMA_KOMISI, d.MASA_MANFAAT, d.STATUS_ASET FROM daftar_aset d JOIN merk m ON d.ID_MERK = m.ID_MERK JOIN ruangan r ON d.ID_RUANGAN = r.ID_RUANGAN JOIN komisi_jemaat k ON d.ID_KOMISI = k.ID_KOMISI WHERE d.STATUS_ASET = 'Aktif'");
                  $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.KODE_BARANG, d.NAMA_BARANG, d.MERK, d.HARGA_PEMBELIAN, d.TANGGAL_PEMBELIAN, d.LOKASI_BARANG, k.NAMA_KOMISI, d.MASA_MANFAAT, d.STATUS_ASET FROM daftar_baru d JOIN komisi_jemaat k ON d.KODE_KOMISI = k.KODE_KOMISI WHERE d.STATUS_ASET = 'Aktif'");
                  while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                      <td><?php echo $a; ?></td>
                      <td><?php echo $row['KODE_BARANG']; ?></td>
                      <td><?php echo $row['NAMA_BARANG']; ?></td>
                      <td><?php echo $row['LOKASI_BARANG']; ?></td>
                      <td><?php echo $row['NAMA_KOMISI']; ?></td>
                      <td>
                        <?php
                          $check = mysqli_query($koneksi,"SELECT * FROM pemeliharaan_berkala WHERE ID_ASET = '".$row['ID_ASET']."' AND STATUS_BERKALA = 'Aktif'");
                          //$check = mysqli_query($koneksi,"SELECT * FROM pemeliharaan_berkala WHERE ID_ASET = '".$row['ID_ASET']."'");
                          if(mysqli_num_rows($check) == 1) {
                            $get = mysqli_fetch_array($check);
                        ?>
                          <!-- <button type="button" data-toggle="modal" data-target="#modal-jadwal-edit" data-id="<?php echo $get['ID_PENJADWALAN']; ?>" class="btn btn-warning modalEdit"><i class="fa fa-calendar-minus-o"></i> Ubah</button> -->
                          <button type="button" data-toggle="modal" data-target="#modal-nonaktif" data-id="<?php echo $get['ID_PENJADWALAN']; ?>" class="btn btn-danger modalDisable"><i class="fa fa-calendar-times-o"></i> Matikan</button>
                        <?php
                          }
                        else {
                          ?>
                          <button type="button" data-toggle="modal" data-target="#modal-jadwal" data-id="<?php echo $row['ID_ASET']; ?>" class="btn btn-primary modalJadwal"><i class="fa fa-calendar-check-o"></i> Jadwalkan</button>
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