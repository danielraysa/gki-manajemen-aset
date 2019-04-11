    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Approval Peminjaman Aset
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
                            <h3 class="box-title">Daftar Pengajuan Peminjaman Aset</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tgl Pengajuan</th>
                                        <th>Pemohon</th>
                                        <th>Keterangan</th>
                                        <th>Status Pengajuan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        //$query = mysqli_query($koneksi,"SELECT p.id_pengadaan, p.keterangan_usulan, p.tanggal_usulan, p.tanggal_modifikasi, p.hasil_approval FROM pengadaan_usul p WHERE p.status_usulan = 'Aktif'");
                                        $query = mysqli_query($koneksi,"SELECT p.id_peminjaman, p.nama_peminjam, p.keterangan_pinjam, p.tanggal_pengajuan, p.hasil_pengajuan FROM peminjaman_aset p WHERE p.status_peminjaman = 'Aktif'");
                                        $a = 1;
                                        while($row = mysqli_fetch_array($query)) {
                                        ?>
                                    <tr>
                                        <td><?php echo $a; ?></td>
                                        <td><?php echo $row['tanggal_pengajuan']; ?></td>
                                        <td><?php echo $row['nama_peminjam']; ?></td>
                                        <td><?php echo $row['keterangan_pinjam']; ?></td>
                                        <td>
                                            <?php
                                                if($row['hasil_approval'] == "Diterima") {
                                                ?>
                                            <button class="btn btn-success"><i class="fa fa-check"></i>
                                                <?php echo $row['hasil_approval']; ?></button>
                                            <?php
                                                }
                                                if($row['hasil_approval'] == "Ditolak") {
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
                                            <button class="btn btn-primary modalDetail" data-toggle="modal" data-target="#modal-detail" data-id="<?php echo $row['id_pengadaan']; ?>"><i class="fa fa-check-square-o"></i> Detail</button>
                                            <?php
                                            if($row['hasil_approval'] == "Pending") {
                                            ?>
                                            <button class="btn btn-success modalApprove" data-toggle="modal" data-target="#modal-approve" data-id="<?php echo $row['id_pengadaan']; ?>"><i class="fa fa-check-circle"></i> Approve</button>
                                            <button class="btn btn-danger modalReject" data-toggle="modal" data-target="#modal-reject" data-id="<?php echo $row['id_pengadaan']; ?>"><i class="fa fa-close"></i> Reject</button>
                                            <?php 
                                            }
                                            else{
                                            ?>
                                            <button disabled class="btn btn-success modalApprove" data-toggle="modal" data-target="#modal-approve" data-id="<?php echo $row['id_pengadaan']; ?>"><i class="fa fa-check-circle"></i> Approve</button>
                                            <button disabled class="btn btn-danger modalReject" data-toggle="modal" data-target="#modal-reject" data-id="<?php echo $row['id_pengadaan']; ?>"><i class="fa fa-close"></i> Reject</button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
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
                            <h3 class="box-title">Pengembalian Aset</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tgl Pengembalian</th>
                                        <th>Pemohon</th>
                                        <th>Keterangan</th>
                                        <th>Status Peminjaman</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        //$query = mysqli_query($koneksi,"SELECT p.id_pengadaan, p.keterangan_usulan, p.tanggal_usulan, p.tanggal_modifikasi, p.hasil_approval FROM pengadaan_usul p WHERE p.status_usulan = 'Aktif'");
                                        $query = mysqli_query($koneksi,"SELECT p.id_peminjaman, p.nama_peminjam, p.keterangan_pinjam, p.tanggal_pengajuan, p.hasil_pengajuan FROM peminjaman_aset p WHERE p.status_peminjaman = 'Aktif'");
                                        $a = 1;
                                        while($row = mysqli_fetch_array($query)) {
                                        ?>
                                    <tr>
                                        <td><?php echo $a; ?></td>
                                        <td><?php echo $row['tanggal_pengembalian']; ?></td>
                                        <td><?php echo $row['nama_peminjam']; ?></td>
                                        <td><?php echo $row['keterangan_pinjam']; ?></td>
                                        <td>
                                            <button class="btn btn-primary"><i class="fa fa-circle-o-notch fa-spin"></i> Terpinjam</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary modalDetail" data-toggle="modal" data-target="#modal-detail" data-id="<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-check-square-o"></i> Detail</button>
                                            <button class="btn btn-success modalApprove" data-toggle="modal" data-target="#modal-approve" data-id="<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-check-circle"></i> Approve</button>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php include "modal.php"; ?>
        </section>
        <!-- /.content -->
    </div>