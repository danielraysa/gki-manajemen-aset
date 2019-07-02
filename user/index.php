<?php
    session_start();
    if (!isset($_SESSION['login_user'])) {
        header("location:../index.php");
    }
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
        Data Pengguna
        <!-- <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="../"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Master</a></li>
        <li class="active">Users</li>
      </ol>
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
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $_SESSION['error-msg']; ?>
        </div>
    <?php
    }
    ?>
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Data User Baru</h3>
                </div>
                <div class="box-body">
                    <form action="form-action.php" method="post">
                    
                    <div class="form-group">
                        <label>Nama Pengguna:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" name="nama" placeholder="Nama pengguna">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>Username:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" name="username" placeholder="Username untuk login">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password untuk login">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>Retype Password:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="password" class="form-control" name="password_2" id="confirm_password" placeholder="Ulangi Password">
                        </div>  
                        <span id="message"></span>
                    </div>
                    <div class="form-group">
                        <label>Hak Akses:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <select class="form-control" id="hak_akses" name="hak_akses">
                                <option value="Peminjam">Peminjam</option>
                                <option value="Anggota MJ">Anggota MJ</option>
                                <option value="Ketua MJ">Ketua MJ</option>
                                <!--<option value="Administrator">Administrator</option>-->
                            </select>
                        </div>  
                    </div>
                    <!-- <div class="form-group">
                        <label>Keterangan:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" name="keterangan" placeholder="Keterangan">
                        </div>  
                    </div> -->
                    
                    <button class="btn btn-success btn-block" type="submit" name="add">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover table-responsive" width="100%">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Pengguna</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Hak Akses</th>
                  
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        //include('plugins/phpqrcode/qrlib.php');
                        $a = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE STATUS_USER = 'Aktif'");
                        while ($select = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $a; ?></td>
                        <td><?php echo $select['NAMA_LENGKAP']; ?></td>
                        <td><?php echo $select['USERNAME']; ?></td>
                        <td>*****</td>
                        <td><?php echo $select['ROLE']; ?></td>
                        
                        <td><center>
                        <button class="btn btn-warning modalLink" data-toggle="modal" data-target="#modal-default" data-id="<?php echo $select['ID_USER']; ?>"><i class="fa fa-pencil"></i> Edit</button> 
                        <button class="btn btn-danger modalDelete" data-toggle="modal" data-target="#modal-delete" delete-id="<?php echo $select['ID_USER']; ?>"><i class="fa fa-trash"></i> Hapus</button>
                        </center> </td>
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
      <!-- /.row -->
      <!-- Modal -->
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <?php include "modal-update.php"; ?>
        </div>
      </div>
      <div class="modal fade" id="modal-delete">
        <div class="modal-dialog modal-sm">
        <form action="form-action.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Hapus Data user</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id-user" class="form-control" name="id_user" value="">
                    Hapus item ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="delete">Hapus</button>
                </div>
            </div>
        </form>
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