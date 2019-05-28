<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengajuan Peminjaman 
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
        <h4><i class="icon fa fa-check"></i> Success!</h4>
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
        <div class="col-lg-4 col-md-12 col-sm-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Data Peminjaman</h3>
            </div>
            <div class="box-body">
            <!-- <form> -->
            <!-- <form action="form-action.php" method="post"> -->
              <!-- <div class="form-group">
                <label>Peminjam:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                <select class="form-control select2" id="peminjam_aset" name="peminjam" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <?php
                    /*
                    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE ROLE = 'Peminjam'");
                    while ($row = mysqli_fetch_array($data)) {
                    ?>
                    <option value="<?php echo $row['ID_USER']; ?>"><?php echo $row['NAMA_LENGKAP']; ?></option>
                    <?php
                    } */
                    ?>
                </select>
                </div>
              </div> -->
              <div class="form-group">
                <label>Komisi Peminjam:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <select class="form-control select2" id="komisi_peminjam" name="komisi" style="width: 100%;">
                    <?php
                    $data = mysqli_query($koneksi, "SELECT * FROM komisi_jemaat");
                    while ($row = mysqli_fetch_array($data)) {
                    ?>
                    <option value="<?php echo $row['ID_KOMISI']; ?>"><?php echo $row['NAMA_KOMISI']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label>Nomor untuk dihubungi:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" class="form-control" id="nohp" name="nohp" required/>
                </div>
                <span id="errmsg"></span>
              </div>
              <div class="form-group">
                <label>Tanggal Pinjam - Kembali:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                <input type="text" class="form-control" id="reservation" name="tgl_pinjam" required>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Keterangan Peminjaman:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
                </div> <br>
                
                <button <?php if(empty($_SESSION['item_pinjam'])) echo "disabled"; ?> class="btn btn-success btn-block" id="btnSimpan" name="simpan-pinjam">Simpan</button>
              </div>
              <!-- <button class="btn btn-success btn-block" type="submit" id="addBtn" name="add-item">Tambah</button> -->
              
            <!-- </form> -->
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Data Aset akan Dipinjam</h3>
              <div class="pull-right">
                <button type="button" class="btn btn-danger emptyData"><i class="fa fa-trash"></i> Hapus Semua</button>
              </div>
            </div>
            
            <!-- /.box-header -->
          <div class="box-body">
            <table id="example2" class="table table-bordered table-hover table-responsive" style="width: 100%">
                <thead>
                <tr>
                <th>No.</th>
                <th>Kode Aset</th>
                <th>Nama Aset</th>
                <th>Barang</th>
                <th>Action</th>
                </thead>
                <tbody>
                  <?php
                    //include('plugins/phpqrcode/qrlib.php');
                    $a = 1;
                    //foreach ($_SESSION["cart_item"] as $select){
                    foreach ($_SESSION["item_pinjam"] as $key => $select){
                  ?>
                  <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $select['kode_aset']; ?></td>
                    <td><?php echo $select['nama_aset']; ?></td>
                    <td><?php echo $select['barang']; ?></td>
                    <td><button type="button" data-id="<?php echo $select['id_aset']; ?>" class="btn btn-danger btn-block remove"><i class="fa fa-trash"></i> Hapus</button></td>
                  </tr>
                  <?php
                    $a++;
                    }
                  ?>
                </tbody>
                
              </table>
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
              <h3 class="box-title">Daftar Aset dapat Dipinjam</h3>
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
                  if(empty($_SESSION['item_pinjam'])){
                    $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.KODE_ASET, d.NAMA_ASET, m.NAMA_MERK, d.HARGA_PEMBELIAN, d.TANGGAL_PEMBELIAN, r.NAMA_RUANGAN, k.NAMA_KOMISI, d.MASA_MANFAAT, d.STATUS_ASET FROM daftar_aset d JOIN merk m ON d.ID_MERK = m.ID_MERK JOIN ruangan r ON d.ID_RUANGAN = r.ID_RUANGAN JOIN komisi_jemaat k ON d.ID_KOMISI = k.ID_KOMISI WHERE d.STATUS_ASET = 'Aktif' AND d.PERBOLEHAN_PINJAM = 1");
                  }
                  else {
                    $arr = array();
                    foreach ($_SESSION["item_pinjam"] as $key => $select){
                      array_push($arr, $select['id_aset']);
                    }
                    $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.KODE_ASET, d.NAMA_ASET, m.NAMA_MERK, d.HARGA_PEMBELIAN, d.TANGGAL_PEMBELIAN, r.NAMA_RUANGAN, k.NAMA_KOMISI, d.MASA_MANFAAT, d.STATUS_ASET FROM daftar_aset d JOIN merk m ON d.ID_MERK = m.ID_MERK JOIN ruangan r ON d.ID_RUANGAN = r.ID_RUANGAN JOIN komisi_jemaat k ON d.ID_KOMISI = k.ID_KOMISI WHERE d.STATUS_ASET = 'Aktif' AND d.PERBOLEHAN_PINJAM = 1 AND d.ID_ASET NOT IN ( '" . implode( "', '" , $arr ) . "' )");
                    //$sql = "SELECT * FROM albums WHERE name NOT IN ( '" . implode( "', '" , $ban_album_names ) . "' )";
                  }
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
                      
                      <td><button type="button" data-id="<?php echo $row['ID_ASET']; ?>" class="btn btn-success addPinjam"><i class="fa fa-plus"></i> Tambah ke Daftar Pinjam</button></td>
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