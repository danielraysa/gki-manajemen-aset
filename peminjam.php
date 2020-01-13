<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Daftar Pengajuan Peminjaman</h3>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-hover table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tgl Pengajuan</th>
                            <th>Tgl Pakai</th>
                            <th>Keterangan</th>
                            <th>Status Pengajuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //$query = mysqli_query($koneksi,"SELECT p.id_peminjaman, p.nama_peminjam, p.no_hp, p.keterangan_pinjam, p.tanggal_peminjaman, p.tanggal_pengajuan, p.hasil_pengajuan FROM peminjaman_aset p WHERE p.status_peminjaman = 'Aktif' AND p.tanggal_peminjaman <= NOW()");
                            $query = mysqli_query($koneksi,"SELECT p.id_peminjaman, u.nama_lengkap, p.no_hp, p.keterangan_pinjam, p.tanggal_peminjaman, p.tanggal_pengajuan, p.hasil_pengajuan FROM peminjaman_aset p JOIN user u ON p.id_user = u.id_user WHERE p.status_peminjaman = 'Aktif' AND p.tanggal_peminjaman >= NOW() AND p.id_user = '".$_SESSION['id_user']."'");
                            $a = 1;
                            while($row = mysqli_fetch_array($query)) {
                            ?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><?php echo tglIndo_full($row['tanggal_pengajuan']); ?></td>
                            <td><?php echo tglIndo($row['tanggal_peminjaman']); ?></td>
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
                                <a role="button" class="btn btn-warning" <?php
                                if($row['hasil_pengajuan'] != "Pending") echo "href='#' disabled";
                                else echo 'href="peminjaman/?edit='.$row['id_peminjaman'].'"';
                                ?>><i class="fa fa-edit"></i>Ubah</button>
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
                <h3 class="box-title">Daftar Peminjaman</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-hover table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tgl Peminjaman</th>
                            <th>Tgl Pengembalian</th>
                            <th>Keterangan</th>
                            <th>Daftar Aset</th>
                            <th>Status Peminjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //$query = mysqli_query($koneksi,"SELECT p.id_pengadaan, p.keterangan_usulan, p.tanggal_usulan, p.tanggal_modifikasi, p.hasil_pengajuan FROM pengadaan_usul p WHERE p.status_usulan = 'Aktif'");
                            $query = mysqli_query($koneksi,"SELECT p.id_peminjaman, u.nama_lengkap, p.keterangan_pinjam, p.no_hp, p.tanggal_pengajuan, p.hasil_pengajuan, p.tanggal_peminjaman, p.tanggal_pengembalian FROM peminjaman_aset p JOIN user u ON p.id_user = u.id_user WHERE p.hasil_pengajuan = 'Diterima' AND p.id_user = '".$_SESSION['id_user']."' AND p.realisasi_pengembalian IS NULL");
                            $a = 1;
                            $date = date('Y-m-d');
                            while($row = mysqli_fetch_array($query)) {
                            ?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><?php echo tglIndo($row['tanggal_peminjaman']); ?></td>
                            <td><?php echo tglIndo($row['tanggal_pengembalian']); ?></td>
                            <td><?php echo $row['keterangan_pinjam']; ?></td>
                            <td><button class="btn btn-primary modalDetail" data-toggle="modal" data-target="#modal-detail" data-id="<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-navicon"></i> Detail</button></td>
                            <td>
                                <?php
                                if ($row['tanggal_pengembalian'] < $date){
                                ?>
                                <button class="btn btn-danger"><i class="fa fa-close"></i> Melewati Batas</button>
                                <?php
                                }
                                else if($row['tanggal_peminjaman'] > $date) {
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