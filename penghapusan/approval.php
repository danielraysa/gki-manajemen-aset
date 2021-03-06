    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Approval Usulan Penghapusan Aset
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
                Berhasil menambah data baru.
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
                            <h3 class="box-title">Daftar Usulan Penghapusan Aset</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-hover table-responsive" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Pengusul</th>
                                        <th>Keterangan</th>
                                        <th>Aset Usulan</th>
                                        <th>Tanggal Ditambahkan</th>
                                        <th>Status Usulan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($koneksi,"SELECT p.id_penghapusan, u.nama_lengkap, p.keterangan_penghapusan, p.tanggal_usulan, p.hasil_approval FROM penghapusan_aset p JOIN user u ON p.id_user = u.id_user WHERE p.status_usulan = 'Aktif' AND p.hasil_approval = 'Pending'");
                                        $a = 1;
                                        while($row = mysqli_fetch_array($query)) {
                                        ?>
                                    <tr>
                                        <td><?php echo $a; ?></td>
                                        <td><?php echo $row['nama_lengkap']; ?></td>
                                        <td><?php echo $row['keterangan_penghapusan']; ?></td>
                                        <td><button class="btn btn-primary modalDetail" data-toggle="modal" data-target="#modal-detail" data-id="<?php echo $row['id_penghapusan']; ?>"><i class="fa fa-check-square-o"></i> Detail</button></td>
                                        <td><?php echo tglIndo_full($row['tanggal_usulan']); ?></td>
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
                                            <button class="btn btn-primary"><i class="fa fa-hourglass-end"></i>
                                                <?php echo $row['hasil_approval']; ?></button>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($row['hasil_approval'] == "Pending") {
                                            ?>
                                            <button class="btn btn-success modalApprove" data-toggle="modal" data-target="#modal-approve" data-id="<?php echo $row['id_penghapusan']; ?>"><i class="fa fa-check-circle"></i> Terima</button>
                                            <button class="btn btn-danger modalReject" data-toggle="modal" data-target="#modal-reject" data-id="<?php echo $row['id_penghapusan']; ?>"><i class="fa fa-close"></i> Tolak</button>
                                            <?php 
                                            }
                                            else{
                                            ?>
                                            <button disabled class="btn btn-success modalApprove" data-toggle="modal" data-target="#modal-approve" data-id="<?php echo $row['id_penghapusan']; ?>"><i class="fa fa-check-circle"></i> Terima</button>
                                            <button disabled class="btn btn-danger modalReject" data-toggle="modal" data-target="#modal-reject" data-id="<?php echo $row['id_penghapusan']; ?>"><i class="fa fa-close"></i> Tolak</button>
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
            <!-- /.row -->
            <?php include "modal.php"; ?>
        </section>
        <!-- /.content -->
    </div>
