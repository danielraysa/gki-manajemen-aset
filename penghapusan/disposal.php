<?php
    session_start();
    if (!isset($_SESSION['login_user'])) {
        header("location:../index.php");
        exit;
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
    ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Penghapusan Aset
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
        <?php echo $_SESSION['success-msg']; ?>
    </div>
    <?php
    }
    if(isset($_GET['error'])) {
    ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-close"></i> Peringatan!</h4>
        <?php echo $_SESSION['error-msg']; ?>
    </div>
    <?php
    }
    ?>
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Daftar Aset yang Dihapus</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="form-action.php" method="post">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <table id="tabeldata" class="table table-bordered table-hover table-responsive" width="100%">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Aset</th>
                    <th>Sisa Umur Manfaat</th>
                    <th>Jumlah Pemeliharaan</th>
                    <th>Nilai Aset</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $id = $_GET['id'];
                  $_SESSION['penghapusan_aset'] = $id;
                  $a = 1;
                  //$query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.NAMA_ASET, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, SUM(CASE WHEN p.STATUS_PEMELIHARAAN = 'SELESAI' THEN +1 ELSE 0 END) as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM daftar_aset d LEFT OUTER JOIN pemeliharaan_aset p ON d.ID_ASET = p.ID_ASET JOIN detil_usulan_penghapusan dp ON dp.ID_ASET = d.ID_ASET WHERE dp.ID_PENGHAPUSAN = '".$id."'");
                  // $query = mysqli_query($koneksi,"SELECT dp.ID_ASET, d.NAMA_ASET, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, (SELECT COUNT(ID_ASET) FROM pemeliharaan_aset WHERE ID_ASET = dp.ID_ASET AND STATUS_PEMELIHARAAN = 'Selesai') as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM detil_usulan_penghapusan dp JOIN daftar_aset d ON dp.ID_ASET = d.ID_ASET WHERE dp.ID_PENGHAPUSAN = '".$id."'");
                  $query = mysqli_query($koneksi,"SELECT dp.ID_ASET, d.NAMA_BARANG, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, (SELECT COUNT(ID_ASET) FROM pemeliharaan_aset WHERE ID_ASET = dp.ID_ASET AND STATUS_PEMELIHARAAN = 'Selesai') as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM detil_usulan_penghapusan dp JOIN daftar_baru d ON dp.ID_ASET = d.ID_ASET WHERE dp.ID_PENGHAPUSAN = '".$id."'");
                  while($row = mysqli_fetch_array($query)){
                      $id_aset = $row['ID_ASET'];
                      $nama_aset = $row['NAMA_BARANG'];
                      $umur = $row['DIFF'];
                      $jml_pemeliharaan = $row['JML_PEMELIHARAAN'];
                      $bagi = ($row['HARGA_PEMBELIAN']-$row['NILAI_RESIDU'])/$row['MASA_MANFAAT'];
                      $nilai = $row['HARGA_PEMBELIAN']-($bagi*($row['MASA_MANFAAT']-$row['DIFF']));
                      
                  //foreach($_SESSION['temp_item_2'] as $items) {
                  ?>
                    <tr>
                      <td><?php echo $a; ?></td>
                      <td><?php echo $nama_aset; ?></td>
                      <td><?php echo $umur; ?> tahun</td>
                      <td><?php echo $jml_pemeliharaan; ?> kali</td>
                      <td><?php echo asRupiah($nilai); ?></td>
                      <td>
                          <input type="hidden" id="id_aset" name="aset[]" value="<?php echo $id_aset; ?>" />
                          <select class="form-control" id="status_aset" name="status[]" style="width: 100%;"  aria-hidden="true">
                              <?php
                              $data = mysqli_query($koneksi, "SELECT * FROM status WHERE NAMA_STATUS != 'Aktif'");
                              while ($row = mysqli_fetch_array($data)) {
                              ?>
                              <option value="<?php echo $row['NAMA_STATUS']; ?>"><?php echo $row['NAMA_STATUS']; ?></option>
                              <?php
                              }
                              ?>
                          </select>
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
            <div class="row">
              <div class="col-xs-6">
                <div class="form-group">
                  <label for="datepicker" class="col-xs-4 control-label">Tanggal Penghapusan:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="datepicker" name="tgl_penghapusan" required>
                    </div>
                </div>
              </div>
              <div class="col-xs-6">
                <input type="hidden" id="id_hapus" name="id_hapus" value="<?php echo $id; ?>" />
                <!-- <button class="btn btn-success" id="btnHapus" name="hapus_aset">Simpan</button> -->
                 <button type="submit" class="btn btn-success" name="hapus_aset">Simpan</button>
              </div>
            </div>
            </form>
          </div>
          <!-- <div class="box-footer">
          <button type="submit" class="btn btn-success" name="hapus_aset">Simpan</button>
          </div> -->
        </div>
      
    </section>
    
  </div>

    <?php include "../footer.php"; ?>
    <?php include "../control-sidebar.php"; ?>
    </div>
    <?php include "modal.php"; ?>
    <?php include "js-script.php"; ?>
</body>
</html>