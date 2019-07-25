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
        Konfigurasi
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
    if(isset($_GET['error'])) {
        ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $_SESSION['error-msg']; ?>
        </div>
    <?php
    }
    ?>
      <div class="box">
          <div class="box-header">
              <h3 class="box-title">Biodata Gereja</h3>
          </div>
          <div class="box-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <center>
                        <h3><?php echo loadKonfigurasi("nama_gereja"); ?></h3>
                        <h4><?php echo loadKonfigurasi("alamat_gereja"); ?> | Telp. <?php echo loadKonfigurasi("no_telp"); ?></h4>
                        <br >
                        <div class="form-group">
                            <label>Logo (Print):</label>
                            <img id="img-upload" class="img-responsive" width="200px" src="../gambar/konfig/<?php echo loadKonfigurasi("logo_print"); ?>" /> 
                        </div>
                        <div class="form-group">
                            <label>Logo Web:</label>
                            <img id="img-upload-2" class="img-responsive" width="100px" src="../gambar/konfig/<?php echo loadKonfigurasi("logo_web"); ?>" />
                        </div>
                    </center>
                
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <form action="form-action.php" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label>Nama Gereja:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" name="nama" value="<?php echo loadKonfigurasi("nama_gereja"); ?>">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>Alamat Gereja:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" name="alamat" value="<?php echo loadKonfigurasi("alamat_gereja"); ?>">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>No. Telepon:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" name="notelp" value="<?php echo loadKonfigurasi("no_telp"); ?>">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>Nama Web:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" name="nama_web" value="<?php echo loadKonfigurasi("nama_web"); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Upload Gambar (File Print):</label>
                        <!-- <img id="img-upload" class="img-responsive" />   -->
                        <div class="btn btn-default btn-file btn-block">
                            Browse… <input type="file" id="imgInp" name="print" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Upload Gambar (Logo Web):</label>
                        <!-- <img id="img-upload-2" class="img-responsive" />   -->
                        <div class="btn btn-default btn-file btn-block">
                            Browse… <input type="file" id="imgInp-2" name="logo" accept="image/*">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label>Upload Gambar (Icon Web):</label>
                        <div class="btn btn-default btn-file btn-block">
                            Browse… <input type="file" id="imgInp-3" name="icon" accept=".ico">
                        </div>
                    </div> -->
                <button class="btn btn-success btn-block" type="submit" name="edit">Simpan</button>
                </form>
                </div>
            </div>
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