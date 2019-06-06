<div id="detil">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="box box-success">
                <div class="box-header">
                    <!-- <h3 class="box-title">Daftar Usulan Pengadaan Aset</h3> -->
                    <button class="btn btn-success Filter" data-toggle="modal" data-target="#modal-filter" data-id="peminjaman"><i class="fa fa-search"></i> Filter</button>
                    <!-- <button class="btn btn-warning Print" data-id="pengadaan"><i class="fa fa-print"></i> Cetak</button> -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover table-responsive" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Aset</th>
                                <th>Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <!-- <th>Realisasi Kembali</th> -->
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                $query = mysqli_query($koneksi,"SELECT d.nama_aset, u.nama_lengkap, p.no_hp, p.keterangan_pinjam, p.tanggal_peminjaman, p.tanggal_pengembalian, p.realisasi_pengembalian, p.hasil_pengajuan FROM peminjaman_aset p JOIN user u ON p.id_user = u.id_user JOIN detail_peminjaman dp ON p.id_peminjaman = dp.id_peminjaman JOIN daftar_aset d ON dp.id_aset = d.id_aset WHERE p.hasil_pengajuan = 'Diterima'");
                                $a = 1;
                                while($row = mysqli_fetch_array($query)) {
                                ?>
                            <tr>
                                <td><?php echo $a; ?></td>
                                <td><?php echo $row['nama_aset']; ?></td>
                                <td><?php echo $row['nama_lengkap']; ?></td>
                                <td><?php echo tglIndo($row['tanggal_peminjaman']); ?></td>
                                <td><?php echo tglIndo($row['tanggal_pengembalian']); ?></td>
                                <!-- <td><?php echo tglIndo($row['realisasi_pengembalian']); ?></td> -->
                                <td><?php echo $row['keterangan_pinjam']; ?></td>
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
</div>
<div id="summary">
    <div class="row">
        <div class="box box-info">
            <div class="box-header">
                <button class="btn btn-success Filter" data-toggle="modal" data-target="#modal-filter" data-id="peminjaman"><i class="fa fa-search"></i> Filter</button>
            </div>
            <div class="box-body">
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <canvas id="myChartA" height="400px"></canvas>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <table id="ringkas" class="table table-bordered table-hover table-responsive" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Aset</th>
                                <th>Jumlah Peminjaman</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>