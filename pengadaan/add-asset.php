<?php
    session_start();
    if (!isset($_SESSION['login_user'])) {
        header("location:../index.php");
    }
    if(!isset($_SESSION['temp_item'])) {
      $_SESSION['temp_item'] = array();
      $_SESSION['temp_item_2'] = array();
    }
    setlocale(LC_NUMERIC, 'INDONESIA');
    
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
        Pengadaan Aset
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
                <div class="box">
                <div class="box-body">
                <form action="form-action.php" enctype="multipart/form-data" method="post">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="box box-success bg-gray">
                            <div class="box-header">
                                <h3 class="box-title">Penamaan Aset</h3>
                            </div>
                            <div class="box-body">
                                <!-- <div class="form-group">
                                    <label>ID Usulan Item:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-laptop"></i>
                                        </div>
                                        <input type="text" class="form-control" id="id_aset" name="id_usulan" readonly/>
                                    </div>  
                                </div> -->
                                <input type="hidden" class="form-control" id="id_aset" name="id_usulan" readonly/>
                                <div class="form-group">
                                    <label>Kode Aset:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-laptop"></i>
                                        </div>
                                        <input type="text" class="form-control" id="kode_aset" name="kode" placeholder="Kode Aset" required>
                                    </div>  
                                </div>
                                <div class="form-group">
                                    <label>Nama Aset:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-laptop"></i>
                                        </div>
                                        <input type="text" class="form-control" id="nama_aset" name="nama" placeholder="Nama Aset" required>
                                    </div>  
                                </div>
                                <div class="form-group">
                                    <label>Nomor Aset:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-laptop"></i>
                                        </div>
                                        <input type="text" class="form-control" id="nomor_aset" name="nomor" placeholder="Nomor Aset" required>
                                    </div>  
                                </div>
                                
                                <div class="form-group">
                                    <label>Jumlah Aset:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-laptop"></i>
                                        </div>
                                        <input disabled type="number" class="form-control" id="jumlah_aset" name="jumlah" placeholder="Jumlah Aset">
                                    </div>  
                                </div>
                                <div class="form-group">
                                    <input class="minimal" type="checkbox" id="check_jml" name="check_jml"> Jumlah lebih dari 1
                                </div>
                                <div class="form-group">
                                    <label>Status:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-laptop"></i>
                                        </div>
                                    <select class="form-control select2" id="status_aset" name="status" style="width: 100%;"  aria-hidden="true">
                                        <?php
                                        $data = mysqli_query($koneksi, "SELECT * FROM status");
                                        while ($row = mysqli_fetch_array($data)) {
                                        ?>
                                        <option value="<?php echo $row['ID_STATUS']; ?>"><?php echo $row['NAMA_STATUS']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="box box-success bg-gray">
                            <div class="box-header">
                                <h3 class="box-title">Keterangan Aset</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Barang:</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                    <select class="form-control select2" id="barang_aset" name="barang" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <?php
                                        $data = mysqli_query($koneksi, "SELECT b.ID_BARANG, k.KODE_KATEGORI, b.NAMA_BARANG FROM barang b JOIN kategori k ON b.ID_KATEGORI = k.ID_KATEGORI");
                                        while ($row = mysqli_fetch_array($data)) {
                                        ?>
                                        <option value="<?php echo $row['ID_BARANG']; ?>" data-item="<?php echo $row['KODE_KATEGORI']; ?>"><?php echo $row['NAMA_BARANG']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <!-- <div class="input-group-btn">
                                        <i class="fa fa-plus"></i><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Tambah</button>
                                    </div> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Merk:</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                    <select class="form-control select2" id="merk_aset" name="merk" style="width: 100%;" aria-hidden="true">
                                        <?php
                                        $data = mysqli_query($koneksi, "SELECT * FROM merk");
                                        while ($row = mysqli_fetch_array($data)) {
                                        ?>
                                        <option value="<?php echo $row['ID_MERK']; ?>"><?php echo $row['NAMA_MERK']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-merk"><i class="fa fa-plus"></i></button>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Seri/Model:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-laptop"></i>
                                        </div>
                                        <input type="text" class="form-control" id="seri_model" name="serimodel" placeholder="Seri/Model" required>
                                    </div>  
                                </div>
                                <div class="form-group">
                                    <label>Penempatan Ruangan:</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                    <select class="form-control select2" id="ruangan_aset" name="ruangan_aset" style="width: 100%;">
                                        <?php
                                        $data = mysqli_query($koneksi, "SELECT * FROM ruangan");
                                        while ($row = mysqli_fetch_array($data)) {
                                        ?>
                                        <option value="<?php echo $row['ID_RUANGAN']; ?>" data-ruang="<?php echo $row['KODE_RUANGAN']; ?>"><?php echo $row['NAMA_RUANGAN']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-ruangan"><i class="fa fa-plus"></i></button>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Penempatan Komisi:</label>
                                    <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                    <select class="form-control select2" id="komisi_aset" name="komisi" style="width: 100%;" aria-hidden="true">
                                        <?php
                                        $data = mysqli_query($koneksi, "SELECT * FROM komisi_jemaat");
                                        while ($row = mysqli_fetch_array($data)) {
                                        ?>
                                        <option value="<?php echo $row['ID_KOMISI']; ?>" data-komisi="<?php echo $row['KODE_KOMISI']; ?>"><?php echo $row['NAMA_KOMISI']." (".$row['KODE_KOMISI'].")"; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-komisi"><i class="fa fa-plus"></i></button>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="minimal" type="checkbox" name="pinjam" checked> Dapat dipinjam
                                </div>
                                <div class="form-group">
                                    <label>Upload Gambar:</label>
                                    <img id="img-upload" class="img-responsive" />  
                                    <div class="btn btn-default btn-file btn-block">
                                        Browse… <input type="file" id="imgInp" name="foto" accept="image/*">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="box box-success bg-gray">
                            <div class="box-header">
                                <h3 class="box-title">Pembelian Aset</h3>
                            </div>
                            <div class="box-body">
                                
                                <div class="form-group">
                                    <label>Harga Pembelian:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <input type="text" class="form-control" id="harga" name="harga_pembelian" placeholder="Harga per item" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Pengadaan:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar-check-o"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" name="tanggal_pengadaan" placeholder="Tanggal pengadaan" required>
                                    </div>  
                                </div>
                                <div class="form-group">
                                    <label>Masa Manfaat:</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="manfaat_aset" name="masa_manfaat" placeholder="Masa manfaat" required>
                                        <div class="input-group-addon">
                                            tahun
                                        </div>
                                    </div>  
                                </div>
                                <div class="form-group">
                                    <label>Nilai Residu:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <input type="text" class="form-control" id="currency" name="nilai_residu" placeholder="Nilai residu">
                                    </div>  
                                </div>
                                <div class="form-group">
                                    <input class="minimal" type="checkbox" name="penyusutan" id="penyusutan" checked> Mengalami Penyusutan Aset
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="box-footer">
                        <button class="btn btn-success btn-block" type="submit" id="addAsset" name="simpan-aset">Tambah Aset</button>
                        <input type="hidden" id="id_aset" name="id"/>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Data Usulan yang Diajukan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- <form action="form-action.php" method="post"> -->
              <table id="example2" class="table table-bordered table-hover table-responsive" style="width:100%">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Aset</th>
                  <th>Jenis Barang</th>
                  <th>Harga</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $id = $_GET['id'];
                $_SESSION['pengadaan_aset'] = $id;
                //$query = mysqli_query($koneksi,"SELECT p.id_usulan_tambah, p.id_pengadaan, b.nama_barang, p.barang_usulan, p.harga FROM pengadaan_barang p JOIN barang b ON p.id_barang = b.id_barang WHERE p.id_pengadaan = '".$id."'");
                $query = mysqli_query($koneksi,"SELECT p.id_usulan_tambah, p.id_pengadaan, b.nama_barang, p.barang_usulan, p.harga FROM detil_usulan_pengadaan p JOIN barang b ON p.id_barang = b.id_barang WHERE p.id_pengadaan = '".$id."'");
                $a = 1;
                while($row = mysqli_fetch_array($query)) {
                //foreach($_SESSION['temp_item_2'] as $items) {
                ?>
                  <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $row['barang_usulan']; ?></td>
                    <td><?php echo $row['nama_barang']; ?></td>
                    <td><?php echo str_replace(',','.',asRupiah($row['harga'])); ?></td>
                    <td>
                      <button class="btn btn-success insert-item" value="<?php echo $row['id_usulan_tambah']; ?>"><i class="fa fa-check"></i> Tambah</button>
                    </td>
                  </tr>
                <?php
                    $a++;
                  }
                ?>
                </tbody>
            </table>
            
            <!-- </form> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
    <?php include "../footer.php"; ?>
    <?php include "../control-sidebar.php"; ?>
    </div>
    <?php include "modal.php"; ?>
    <?php include "js-script.php"; ?>
</body>
</html>