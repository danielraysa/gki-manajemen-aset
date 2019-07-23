<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usulan Pengadaan Aset
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
        <div class="col-lg-4 col-md-12 col-sm-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Tambah Usulan Pengadaan</h3>
            </div>
            <div class="box-body">
            <form action="form-action.php" id="form_add" method="post">
              <div class="form-group">
                <label>Usulan Aset:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <select class="form-control select2" id="barangusulan" name="barangusulan" style="width: 100%;">
                    <option>Pilih barang</option>
                    <?php
                      //$data = mysqli_query($koneksi, "SELECT DISTINCT(BARANG_USULAN) as NAMA_BARANG FROM `detil_usulan_pengadaan` UNION SELECT DISTINCT(NAMA_ASET) FROM daftar_aset");
                      $data = mysqli_query($koneksi, "SELECT DISTINCT(BARANG_USULAN) as NAMA_BARANG, ID_BARANG FROM `detil_usulan_pengadaan` UNION SELECT DISTINCT(d.NAMA_ASET), b.ID_BARANG FROM daftar_aset d JOIN detil_usulan_pengadaan du ON d.ID_USULAN_TAMBAH = du.ID_USULAN_TAMBAH JOIN barang b ON du.ID_BARANG = b.ID_BARANG");
                      while ($row = mysqli_fetch_array($data)) {
                    ?>
                      <option value="<?php echo $row['NAMA_BARANG']; ?>" data-items="<?php echo $row['ID_BARANG']; ?>"><?php echo $row['NAMA_BARANG']; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                  <input type="hidden" name="barang_backup" id="barang_backup"/>
                </div>
              </div>
              <div class="form-group">
                <input class="minimal" type="checkbox" id="barangbaru" name="barangbaru" > Barang usulan baru
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Usulan barang baru" disabled>
                </div>  
              </div>
              <div class="form-group">
                <label>Barang:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <select class="form-control select2" id="barang" name="barang" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <option>Pilih barang</option>
                    <?php
                      $data = mysqli_query($koneksi, "SELECT * FROM barang");
                      while ($row = mysqli_fetch_array($data)) {
                    ?>
                      <option value="<?php echo $row['ID_BARANG']; ?>"><?php echo $row['NAMA_BARANG']; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                  <!-- <input type="hidden" name="nama_barang" id="nama_barang"/> -->
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label>Harga:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                    </div>
                    <input type="text" class="form-control" id="currency" name="harga" placeholder="Harga per item" required>
                    <input type="hidden" name="rupiah" id="rupiah" />
                </div>  
              </div>

              <button class="btn btn-success btn-block" type="submit" id="addBtn" name="add-item">Tambah</button>
                </form>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Data Usulan yang Diajukan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form action="form-action.php" method="post">
              <table id="example2" class="table table-bordered table-hover table-responsive" style="width: 100%">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Usulan Aset</th>
                  <th>Barang</th>
                  <th>Harga</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                /*
                  $query = mysqli_query($koneksi,"SELECT p.id_pengadaan, p.barang_usulan, b.nama_barang, p.id_barang, p.jumlah, p.harga, p.keterangan_usulan, p.tanggal_modifikasi, p.hasil_approval FROM pengadaan p JOIN barang b ON p.id_barang = b.id_barang WHERE p.hasil_approval = 'Pending' AND p.status_usulan = 'Aktif'");
                  $a = 1;
                  while($row = mysqli_fetch_array($query)) { */
                    $a = 1;
                    foreach($_SESSION['temp_item_2'] as $items) {
                ?>
                  <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $items['nama']; ?></td>
                    <td><?php echo $items['jenis']; ?></td>
                    <td><div id="txt_harga"><?php echo $items['harga']; ?></div></td>
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
              if(empty($_SESSION['temp_item'])) {
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
              <h3 class="box-title">Histori Usulan Pengadaan Aset</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover table-responsive" style="width: 100%">
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
                  $query = mysqli_query($koneksi,"SELECT p.id_pengadaan, p.keterangan_usulan, p.tanggal_usulan, p.hasil_approval FROM pengadaan_aset p WHERE p.status_usulan = 'Aktif' AND p.id_user = '".$_SESSION['id_user']."' ORDER BY p.tanggal_usulan DESC");
                  $a = 1;
                  while($row = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $row['keterangan_usulan']; ?></td>
                    <td><button class="btn btn-primary modalDetail" data-toggle="modal" data-target="#modal-detail" data-id="<?php echo $row['id_pengadaan']; ?>"><i class="fa fa-check-square-o"></i> Detail</button></td>
                    <td><?php echo strftime("%d %B %Y %H:%M:%S", strtotime($row['tanggal_usulan'])); ?></td>
                    
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
                      <button disabled class="btn btn-success modalAset"><i class="fa fa-plus"></i> Tambah Aset</button>
                      <button class="btn btn-danger modalDelete" data-toggle="modal" data-target="#modal-delete" data-id="<?php echo $row['id_pengadaan']; ?>"><i class="fa fa-trash"></i> Hapus Usulan</button>
                      <?php
                      }
                      if($row['hasil_approval'] == "Diterima") {
                      ?>
                      <!-- <button class="btn btn-primary modalAset" data-toggle="modal" data-target="#modal-aset" data-id="<?php echo $row['id_pengadaan']; ?>"><i class="fa fa-plus"></i> Tambah Aset</button> -->
                      <a role="button" class="btn btn-success" href="add-asset.php?id=<?php echo $row['id_pengadaan']; ?>"><i class="fa fa-plus"></i> Tambah Aset</a>
                      <button disabled class="btn btn-danger modalDelete" data-toggle="modal" data-target="#modal-delete" data-id="<?php echo $row['id_pengadaan']; ?>"><i class="fa fa-trash"></i> Hapus Usulan</button>
                      <?php
                      }
                      if($row['hasil_approval'] == "Ditolak") {
                      ?>
                      <button disabled class="btn btn-success modalAset"><i class="fa fa-plus"></i> Tambah Aset</button>
                      <button disabled class="btn btn-danger modalDelete" data-toggle="modal" data-target="#modal-delete" data-id="<?php echo $row['id_pengadaan']; ?>"><i class="fa fa-trash"></i> Hapus Usulan</button>
                      <?php
                      }
                      ?>
                      <!-- <button disabled class="btn btn-primary modalAset" data-toggle="modal" data-target="#modal-aset" data-id="<?php echo $row['id_pengadaan']; ?>"><i class="fa fa-plus"></i> Tambah Aset</button> 
                      <button disabled class="btn btn-success" data-toggle="modal" data-target="#modal-aset" data-id="<?php echo $row['id_pengadaan']; ?>"><i class="fa fa-refresh"></i> Usulkan Lagi</button> -->
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