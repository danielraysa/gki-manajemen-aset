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
        Profil Pengguna
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
              
          </div>
          <div class="box-body">
            <div class="row">
            <form action="form-action.php" enctype="multipart/form-data" method="post">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <center>
                        <div class="form-group">
                            <img id="img-upload" class="img-responsive img-circle" width="200px" src="../gambar/user/<?php echo $_SESSION['foto_user']; ?>" /> 
                        </div>
                        <div class="form-group">
                        <label>Upload Foto/Gambar:</label>
                        <!-- <img id="img-upload" class="img-responsive" />   -->
                        <div class="btn btn-default btn-file btn-block">
                            Browse… <input type="file" id="imgInp" name="foto" accept="image/*" capture>
                        </div>
                    </div>
                    </center>
                
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="form-group">
                        <label>Nama Lengkap:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" name="nama" value="<?php echo $_SESSION['nama_user']; ?>">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>Username:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username']; ?>">
                        </div>  
                    </div>
                    <div class="form-group">
                        <input class="minimal" type="checkbox" id="change_pass" name="change_pass"> Ubah password
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="password" class="form-control" id="pass" name="password" disabled>
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>Ulangi Password:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="password" class="form-control" id="ulang_pass" name="ulang" disabled>
                        </div>  
                    </div>
                    
                <button class="btn btn-success btn-block" type="submit" name="edit">Simpan</button>
                </div>
            </form>
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