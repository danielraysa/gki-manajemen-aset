    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Peminjaman Aset
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
                            <h3 class="box-title">Daftar Pengajuan Peminjaman Aset</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-hover table-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tgl Pengajuan</th>
                                        <th>Pemohon</th>
                                        <th>No. HP</th>
                                        <th>Tgl Pakai</th>
                                        <th>Keterangan</th>
                                        <th>Status Pengajuan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $date = date('Y-m-d');
                                        $query = mysqli_query($koneksi,"SELECT p.id_peminjaman, u.nama_lengkap, p.no_hp, p.keterangan_pinjam, p.tanggal_peminjaman, p.tanggal_pengembalian, p.tanggal_pengajuan, p.hasil_pengajuan FROM peminjaman_aset p JOIN user u ON p.id_user = u.id_user WHERE p.status_peminjaman = 'Aktif' AND p.hasil_pengajuan = 'Pending' AND p.tanggal_peminjaman >= CURDATE() ORDER BY p.tanggal_pengajuan");
                                        $a = 1;
                                        while($row = mysqli_fetch_array($query)) {
                                        ?>
                                    <tr>
                                        <td><?php echo $a; ?></td>
                                        <td><?php echo tglIndo_full($row['tanggal_pengajuan']); ?></td>
                                        <td><?php echo $row['nama_lengkap']; ?></td>
                                        <td><?php echo $row['no_hp']; ?></td>
                                        <td><?php echo tglIndo($row['tanggal_peminjaman'])." - ".tglIndo($row['tanggal_pengembalian']); ?></td>
                                        <td><?php echo $row['keterangan_pinjam']; ?></td>
                                        <td>
                                            <?php
                                                if($row['hasil_pengajuan'] == "Diterima") {
                                                ?>
                                            <button class="btn btn-success"><i class="fa fa-check"></i>
                                                <?php echo $row['hasil_pengajuan']; ?></button>
                                            <?php
                                                }
                                                if($row['hasil_pengajuan'] == "Ditolak") {
                                            ?>
                                            <button class="btn btn-danger"><i class="fa fa-close"></i>
                                                <?php echo $row['hasil_pengajuan']; ?></button>
                                            <?php
                                                }
                                                if($row['hasil_pengajuan'] == "Pending") {
                                            ?>
                                            <button class="btn btn-primary"><i class="fa fa-hourglass-end"></i>
                                                <?php echo $row['hasil_pengajuan']; ?></button>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary modalDetail" data-toggle="modal" data-target="#modal-detail" data-id="<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-navicon"></i> Detail</button>
                                            <?php
                                            if($row['hasil_pengajuan'] == "Pending") {
                                            ?>
                                            <button class="btn btn-success modalApprove" data-toggle="modal" data-target="#modal-approve" data-id="<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-check-circle"></i> Terima</button>
                                            <button class="btn btn-danger modalReject" data-toggle="modal" data-target="#modal-reject" data-id="<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-close"></i> Tolak</button>
                                            <?php 
                                            }
                                            else{
                                            ?>
                                            <button disabled class="btn btn-success modalApprove" data-toggle="modal" data-target="#modal-approve" data-id="<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-check-circle"></i> Terima</button>
                                            <button disabled class="btn btn-danger modalReject" data-toggle="modal" data-target="#modal-reject" data-id="<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-close"></i> Tolak</button>
                                            <?php
                                            }
                                            ?>
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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Daftar Peminjaman Aset</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover table-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tgl Peminjaman</th>
                                        <th>Tgl Pengembalian</th>
                                        <th>Pemohon</th>
                                        <th>Keterangan</th>
                                        <th>Status Peminjaman</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        //$query = mysqli_query($koneksi,"SELECT p.id_pengadaan, p.keterangan_usulan, p.tanggal_usulan, p.tanggal_modifikasi, p.hasil_pengajuan FROM pengadaan_usul p WHERE p.status_usulan = 'Aktif'");
                                        $query = mysqli_query($koneksi,"SELECT p.id_peminjaman, u.nama_lengkap, p.keterangan_pinjam, p.no_hp, p.tanggal_pengajuan, p.hasil_pengajuan, p.tanggal_peminjaman, p.tanggal_pengembalian FROM peminjaman_aset p JOIN user u ON p.id_user = u.id_user WHERE p.hasil_pengajuan = 'Diterima' AND p.realisasi_pengembalian IS NULL ORDER BY p.tanggal_peminjaman");
                                        $a = 1;
                                        while($row = mysqli_fetch_array($query)) {
                                        ?>
                                    <tr>
                                        <td><?php echo $a; ?></td>
                                        <td><?php echo tglIndo($row['tanggal_peminjaman']); ?></td>
                                        <td><?php echo tglIndo($row['tanggal_pengembalian']); ?></td>
                                        <td><?php echo $row['nama_lengkap']; ?></td>
                                        <td><?php echo $row['keterangan_pinjam']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['tanggal_pengembalian'] < $date){
                                            ?>
                                            <button class="btn btn-danger"><i class="fa fa-close"></i> Melewati Batas</button>
                                            <?php
                                            }
                                            else if ($row['tanggal_peminjaman'] > $date){
                                            ?>
                                            <button class="btn btn-success"><i class="fa fa-check"></i> Siap Pinjam</button>
                                            <?php
                                            }
                                            else {
                                            ?>
                                            <button class="btn btn-primary"><i class="fa fa-external-link-square"></i> Terpinjam</button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <!-- <a target="_blank" class="btn btn-primary modalDetail" href="testprint.php?print_id=<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-navicon"></i> Print</a> -->
                                            <button class="btn btn-primary modalPinjam" data-toggle="modal" data-target="#modal-pinjam" data-id="<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-navicon"></i> Detail</button>
                                            <button class="btn btn-success modalKembali" data-toggle="modal" data-target="#modal-pengembalian" data-id="<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-share-square"></i> Pengembalian</button>
                                            <!-- <button class="btn btn-success modalGambar" data-toggle="modal" data-target="#modal-gambar" data-id="<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-share-square"></i> Gambar</button> -->
                                            <?php
                                            if ($row['tanggal_pengembalian'] <= $date){
                                            ?>
                                            <button class="btn btn-warning btnSms" data-id="<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-envelope"></i> Kirim Pengingat</button>
                                            <!-- <a role="button" href="https://wa.me/6281235607716?text=Saya%20tertarik%20untuk%20membeli%20mobil%20Anda%20(TEST)" target="_blank" class="btn btn-success" data-id="<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-envelope"></i> WA</button> -->
                                            <?php
                                            }
                                            ?>
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
            <?php include "modal.php"; ?>
        </section>
        <!-- /.content -->
    </div>