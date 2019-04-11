<?php
    session_start();
    if (!isset($_SESSION['login_user'])) {
        header("location:login/");
    }
    if(!isset($_SESSION["cart_item"])) {
		$_SESSION["cart_item"] = array();
	}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "css-script.php"; ?>
    <?php include "connection.php"; ?>
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
        Data Tables
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">90<small>%</small></span>
                <button class="btn btn-sm btn-success btn-block">Hello</button>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Jumlah Aset</span>
                <span class="info-box-number">41,410</span>

                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Pengajuan Peminjaman</span>
                <span class="info-box-number">41,410</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                        70% Increase in 30 Days
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Aset Terpinjam</span>
                <span class="info-box-number">41,410</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                        70% Increase in 30 Days
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-gears"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Pemeliharaan Aset</span>
                <span class="info-box-number">41,410</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                        70% Increase in 30 Days
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- Info boxes -->
        <div class="row">
            <div class="col-xs-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Input items</h3>
                    </div>
                    <div class="box-body">
                    <!-- IP mask -->
                        <div class="form-group">
                            <label>Item ID:</label>
                            <form method="post" action="action.php">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" name="id_barcode" placeholder="Scan the QR Code" autofocus>
                                <span class="input-group-btn">
                                    <button type="submit" name="scan" class="btn btn-success"><i class="fa fa-laptop"></i> Scan</button>
                                </span>
                            </div>
                            </form>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-8">
                <div class="box box-info">
                    <div class="box-header">
                    <form method="post" action="action.php">
                        <h3 class="box-title">Scanned Items</h3>
                        <button style="float: right; margin-left: 5px;" type="submit" name="add" class="btn btn-success"><i class="fa fa-plus-square"></i> Add to Database</button>
                        <button style="float: right;" type="submit" name="empty" class="btn btn-danger"><i class="fa fa-shopping-cart"></i> Empty cart</button>
                    </form>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                        <th>No.</th>
                        <th>ID Sarpras</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        </thead>
                        <tbody>
                            <?php
                                //include('plugins/phpqrcode/qrlib.php');
                                $a = 1;
                                foreach ($_SESSION["cart_item"] as $select){
                            ?>
                            <tr>
                                <td><?php echo $a; ?></td>
                                <td><?php echo $select['id']; ?></td>
                                <td><?php echo $select['nama']; ?></td>
                                <td><?php echo $select['jenis']; ?></td>
                                <td><?php echo $select['qty']; ?></td>
                            </tr>
                            <?php
                                    $a++;
                                }
                            ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>ID Sarpras</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                    <!-- /.box-body -->
                    
                </div>
                <!-- /.box -->
                </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover table-responsive">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>ID Sarpras</th>
                  <th>Nama</th>
                  <th>Jenis</th>
                  <th>Jumlah</th>
                  <th>Tempat</th>
                  <th>Gambar</th>
                  <th>Tanggal Ditambahkan</th>
                  <th>QR Code</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        //include('plugins/phpqrcode/qrlib.php');
                        $a = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM sarpras");
                        while ($select = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $a; ?></td>
                        <td><?php echo $select['id']; ?></td>
                        <td><?php echo $select['nama']; ?></td>
                        <td><?php echo $select['jenis']; ?></td>
                        <td><?php echo $select['jumlah']; ?></td>
                        <td><?php echo $select['tempat']; ?></td>
                        <td><?php echo $select['gambar']; ?></td>
                        <td><?php echo $select['tgl_added']; ?></td>
                        <!-- <td><img src="https://chart.googleapis.com/chart?cht=qr&chl=<?php //echo $select['id']; ?>&chs=100x100&chld=L|0" alt="qrcode.php?id=<?php //echo $select['id']; ?>" /></td> -->
                        <td><img src="qrcode.php?id=<?php echo $select['id']; ?>" /></td>
                    </tr>
                    <?php
                        $a++;
                        }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>ID Sarpras</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Tempat</th>
                    <th>Gambar</th>
                    <th>Tanggal Ditambahkan</th>
                    <th>QR Code</th>
                </tr>
                </tfoot>
              </table>
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
    <?php include "footer.php"; ?>
    <?php include "control-sidebar.php"; ?>
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