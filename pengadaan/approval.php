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
                    Data Master
                    <small>Sarana Prasarana</small>
                </h1>

            </section>
            <!-- Main content -->
            <section class="content">
                <?php
                    if(isset($_GET['success'])) {
                ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    Success adding new data. This alert is dismissable.
                </div>
                <?php
                        }
                    if(isset($_GET['edit'])) {
                    ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    Success editing data. This alert is dismissable.
                </div>
                <?php
                        }
                    if(isset($_GET['delete'])) {
                    ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    Success deleting data. This alert is dismissable.
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
                                <h3 class="box-title">Histori Usulan Pengadaan Aset</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Aset</th>
                                            <th>Jenis Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Tanggal Ditambahkan</th>
                                            <th>Tanggal Perubahan</th>
                                            <th>Status Usulan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = mysqli_query($koneksi,"SELECT p.id_pengadaan, p.barang_usulan, b.nama_barang, p.id_barang, p.jumlah, p.harga, p.keterangan_usulan, p.tanggal_usulan, p.tanggal_modifikasi, p.hasil_approval FROM pengadaan p JOIN barang b ON p.id_barang = b.id_barang WHERE p.status_usulan = 'Aktif'");
                                            $a = 1;
                                            while($row = mysqli_fetch_array($query)) {
                                            ?>
                                        <tr>
                                            <td>
                                                <?php echo $a; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['barang_usulan']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['nama_barang']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['jumlah']; ?>
                                            </td>
                                            <td id="txt_harga">
                                                <?php echo $row['harga']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['tanggal_usulan']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['tanggal_modifikasi']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($row['hasil_approval'] == "Approved") {
                                                    ?>
                                                <button class="btn btn-success"><i class="fa fa-check"></i>
                                                    <?php echo $row['hasil_approval']; ?></button>
                                                <?php
                                                    }
                                                    if($row['hasil_approval'] == "Rejected") {
                                                ?>
                                                <button class="btn btn-danger"><i class="fa fa-close"></i>
                                                    <?php echo $row['hasil_approval']; ?></button>
                                                <?php
                                                    }
                                                    if($row['hasil_approval'] == "Pending") {
                                                ?>
                                                <button class="btn btn-primary"><i class="fa fa-circle-o-notch fa-spin"></i>
                                                    <?php echo $row['hasil_approval']; ?></button>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-success modalApprove" data-toggle="modal"
                                                    data-target="#modal-approve" data-id="<?php echo $row['id_pengadaan']; ?>"><i
                                                        class="fa fa-check-circle"></i> Approve</button>
                                                        <button class="btn btn-danger modalReject" data-toggle="modal"
                                                    data-target="#modal-reject" data-id="<?php echo $row['id_pengadaan']; ?>"><i
                                                        class="fa fa-close"></i> Reject</button>
                                                <button class="btn btn-default" disabled><i class="fa fa-check"></i>
                                                    Sudah dipilih</button>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>ID Usulan</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Ditambahkan</th>
                                            <th>Status Usulan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
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