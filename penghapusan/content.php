<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usulan Penghapusan Aset
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
        Berhasil melakukan penghapusan aset.
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
        <h4><i class="icon fa fa-trash"></i> Alert!</h4>
       <?php echo $_SESSION['success-msg']; ?>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Data Usulan yang Diajukan</h3>
            </div>
            <div class="box-body">
            <form action="form-action.php" method="post">
              <table id="example2" class="table table-bordered table-hover table-responsive" style="width:100%">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Usulan Aset</th>
                  <th>Sisa Umur Manfaat</th>
                  <th>Total Pemeliharaan</th>
                  <th>Nilai Aset</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                /*
                  $query = mysqli_query($koneksi,"SELECT p.id_penghapusan, p.barang_usulan, b.nama_barang, p.id_barang, p.jumlah, p.harga, p.keterangan_usulan, p.tanggal_modifikasi, p.hasil_approval FROM penghapusan p JOIN barang b ON p.id_barang = b.id_barang WHERE p.hasil_approval = 'Pending' AND p.status_usulan = 'Aktif'");
                  $a = 1;
                  while($row = mysqli_fetch_array($query)) { */
                    $a = 1;
                    foreach($_SESSION['temp_hapus'] as $items) {
                ?>
                  <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $items['nama']; ?></td>
                    <td><?php echo $items['umur']; ?> tahun</td>
                    <td><?php echo $items['jumlah_pemeliharaan']; ?> kali</td>
                    <td><?php echo asRupiah($items['nilai']); ?></td>
                    <td>
                      <button class="btn btn-danger" type="submit" name="hapus-item" value="<?php echo $items['temp_id']; ?>"><i class="fa fa-trash"></i> Hapus</button>
                    </td>
                  </tr>
                <?php
                    $a++;
                  }
                ?>
                </tbody>
            </table>
            <div class="form-group">
              <label>Keterangan Usulan:</label>
              <div class="input-group">
                <div class="input-group-addon">
                <i class="fa fa-laptop"></i>
                </div>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
              </div> <br>
              <?php
              if(empty($_SESSION['temp_hapus'])) {
              ?>
              <button disabled class="btn btn-success btn-block" type="submit" name="simpan-usulan">Simpan</button>
              <?php
              }
              else{
              ?>
              <button class="btn btn-success btn-block" type="submit" name="simpan-usulan">Simpan</button>
              <?php
              }
              ?>
            </div>
            </form>
            </div>
          </div>
        </div>
        <!-- </div>
      <div class="row"> -->
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Daftar Aset Direkomendasikan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover table-responsive" style="width: 100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Aset</th>
                    <th>Sisa Umur Manfaat</th>
                    <th>Total Pemeliharaan</th>
                    <th>Nilai Aset</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                if (empty($_SESSION['temp_hapus'])) {
                  //$query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.NAMA_ASET, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, SUM(CASE WHEN p.STATUS_PEMELIHARAAN = 'Selesai' THEN +1 ELSE 0 END) as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM daftar_aset d LEFT OUTER JOIN pemeliharaan_aset p ON d.ID_ASET = p.ID_ASET WHERE d.STATUS_ASET = 'Aktif' GROUP BY p.ID_ASET");
                  $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.NAMA_ASET, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, (SELECT COUNT(ID_ASET) FROM pemeliharaan_aset WHERE ID_ASET = d.ID_ASET AND STATUS_PEMELIHARAAN = 'Selesai') as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM daftar_aset d WHERE d.STATUS_ASET = 'Aktif' HAVING JML_PEMELIHARAAN > 0 ORDER BY JML_PEMELIHARAAN DESC");
                }
                else {
                  $arr = array();
                  foreach ($_SESSION["temp_hapus"] as $key => $select){
                    array_push($arr, $select['id_aset']);
                  }
                  //$query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.NAMA_ASET, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, SUM(CASE WHEN p.STATUS_PEMELIHARAAN = 'Selesai' THEN +1 ELSE 0 END) as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM daftar_aset d LEFT OUTER JOIN pemeliharaan_aset p ON d.ID_ASET = p.ID_ASET WHERE d.STATUS_ASET = 'Aktif' AND d.ID_ASET NOT IN ('".implode("', '", $arr)."') GROUP BY p.ID_ASET");
                  $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.NAMA_ASET, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, (SELECT COUNT(ID_ASET) FROM pemeliharaan_aset WHERE ID_ASET = d.ID_ASET AND STATUS_PEMELIHARAAN = 'Selesai') as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM daftar_aset d WHERE d.STATUS_ASET = 'Aktif' AND d.ID_ASET NOT IN ('".implode("', '", $arr)."') HAVING JML_PEMELIHARAAN > 0 ORDER BY JML_PEMELIHARAAN DESC");
                }
                  $a = 1;
                  while($row = mysqli_fetch_array($query)) {
                    /* $futureDate=date('Y-m-d', strtotime('+'.$row['MASA_MANFAAT'].' year', strtotime($row['TANGGAL_PEMBELIAN'])) );
                    $d1 = new DateTime($futureDate);
                    $d2 = new DateTime($row['TANGGAL_PEMBELIAN']);

                    $diff = $d2->diff($d1);
                    echo $diff->y; */
                    $bagi = ($row['HARGA_PEMBELIAN']-$row['NILAI_RESIDU'])/$row['MASA_MANFAAT'];
                    $nilai = $row['HARGA_PEMBELIAN']-($bagi*($row['MASA_MANFAAT']-$row['DIFF']));
                ?>
                  <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $row['NAMA_ASET']; ?></td>
                    <td><?php echo $row['DIFF']; ?> tahun</td>
                    <td><?php echo $row['JML_PEMELIHARAAN']; ?> kali</td>
                    <td id=""><?php echo asRupiah($nilai); ?></td>
                    <td>
                      <button class="btn btn-success modalDelete" data-toggle="modal" data-target="#modal-usulan-hapus" data-id="<?php echo $row['ID_ASET']; ?>"><i class="fa fa-plus"></i> Tambah Usulan</button>
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
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Histori Usulan Penghapusan Aset</h3>
            </div>
            <div class="box-body">
              <table id="tabeldata" class="table table-bordered table-hover table-responsive" style="width: 100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Keterangan</th>
                    <th>Aset Usulan</th>
                    <th>Tanggal Ditambahkan</th>
                    <th>Status Usulan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $query = mysqli_query($koneksi,"SELECT p.id_penghapusan, p.keterangan_penghapusan, p.tanggal_usulan, p.hasil_approval FROM penghapusan_aset p WHERE p.status_usulan = 'Aktif' AND p.id_user = '".$_SESSION['id_user']."'");
                  //$query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.NAMA_ASET, d.MASA_MANFAAT, d.TANGGAL_PEMBELIAN, DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR) AS EXP_DATE, TIMESTAMPDIFF(YEAR,CURRENT_DATE(),DATE_ADD(d.TANGGAL_PEMBELIAN, INTERVAL (d.MASA_MANFAAT) YEAR)) AS DIFF, SUM(CASE WHEN p.STATUS_PEMELIHARAAN = 'SELESAI' THEN +1 ELSE 0 END) as JML_PEMELIHARAAN, d.NILAI_RESIDU, d.HARGA_PEMBELIAN FROM daftar_aset d LEFT OUTER JOIN pemeliharaan_aset p ON d.ID_ASET = p.ID_ASET WHERE d.STATUS_ASET = 'Aktif' GROUP BY p.ID_ASET");
                  $a = 1;
                  while($row = mysqli_fetch_array($query)) {
                    //$bagi = ($row['HARGA_PEMBELIAN']-$row['NILAI_RESIDU'])/$row['MASA_MANFAAT'];
                    //$nilai = $row['HARGA_PEMBELIAN']-($bagi*($row['MASA_MANFAAT']-$row['DIFF']));
                ?>
                  <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $row['keterangan_penghapusan']; ?></td>
                    <td><button class="btn btn-primary modalDetail" data-toggle="modal" data-target="#modal-detail" data-id="<?php echo $row['id_penghapusan']; ?>"><i class="fa fa-check-square-o"></i> Detail</button></td>
                    <td><?php echo tglIndo_full($row['tanggal_usulan']); ?></td>
                    <td>
                      <?php
                        if($row['hasil_approval'] == "Diterima") {
                        ?>
                        <button class="btn btn-success"><i class="fa fa-check"></i> <?php echo $row['hasil_approval']; ?></button>
                        <?php
                        }
                        if($row['hasil_approval'] == "Ditolak") {
                        ?>
                        <button class="btn btn-danger"><i class="fa fa-close"></i> <?php echo $row['hasil_approval']; ?></button>
                        <?php
                        }
                        if($row['hasil_approval'] == "Pending") {
                      ?>
                        <button class="btn btn-warning"><i class="fa fa-circle-o-notch fa-spin"></i> <?php echo $row['hasil_approval']; ?></button>
                      <?php
                        }
                      ?>
                    </td>
                    <td>
                      <?php
                      if($row['hasil_approval'] == "Pending") {
                      ?>
                      <button disabled class="btn btn-warning"><i class="fa fa-download"></i> Penghapusan </button>
                      <button class="btn btn-danger modalDelete" data-toggle="modal" data-target="#modal-delete" data-id="<?php echo $row['id_penghapusan']; ?>"><i class="fa fa-trash"></i> Hapus Usulan</button>
                      <?php
                      }
                      if($row['hasil_approval'] == "Diterima") {
                      ?>
                      <!-- <button class="btn btn-primary modalAset" data-toggle="modal" data-target="#modal-aset" data-id="<?php echo $row['id_penghapusan']; ?>"><i class="fa fa-plus"></i> Tambah Aset</button> -->
                      <a role="button" class="btn btn-warning" href="disposal.php?id=<?php echo $row['id_penghapusan']; ?>"><i class="fa fa-download"></i> Penghapusan</a>
                      <button disabled class="btn btn-danger modalDelete" data-toggle="modal" data-target="#modal-delete" data-id="<?php echo $row['id_penghapusan']; ?>"><i class="fa fa-trash"></i> Hapus Usulan</button>
                      <?php
                      }
                      if($row['hasil_approval'] == "Ditolak") {
                      ?>
                      <button disabled class="btn btn-warning"><i class="fa fa-download"></i> Penghapusan </button>
                      <button disabled class="btn btn-danger modalDelete" data-toggle="modal" data-target="#modal-delete" data-id="<?php echo $row['id_penghapusan']; ?>"><i class="fa fa-trash"></i> Hapus Usulan</button>
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
      
    </section>
    <!-- /.content -->
  </div>