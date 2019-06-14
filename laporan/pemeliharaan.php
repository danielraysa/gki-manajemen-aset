<div id="detil">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="box box-success">
                <div class="box-header">
                    <!-- <h3 class="box-title">Daftar Usulan Pengadaan Aset</h3> -->
                    <button class="btn btn-success Filter" data-toggle="modal" data-target="#modal-filter" data-id="pemeliharaan"><i class="fa fa-search"></i> Filter</button>
                    <button class="btn btn-primary" data-id="pemeliharaan"><i class="fa fa-file"></i> Print</button>
                    <!-- <button class="btn btn-warning Print" data-id="pengadaan"><i class="fa fa-print"></i> Cetak</button> -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover table-responsive" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Aset</th>
                                <th>Hasil Pemeliharaan</th>
                                <th>Biaya Pemeliharaan</th>
                                <th>Tanggal Penjadwalan</th>
                                <th>Tanggal Pemeliharaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = mysqli_query($koneksi,"SELECT p.ID_PEMELIHARAAN, p.ID_ASET, d.KODE_ASET, d.NAMA_ASET, p.HASIL_PEMELIHARAAN, p.BIAYA_PEMELIHARAAN, p.TANGGAL_PENJADWALAN, p.TANGGAL_PEMELIHARAAN FROM pemeliharaan_aset p LEFT OUTER JOIN daftar_aset d ON p.ID_ASET = d.ID_ASET WHERE p.STATUS_PEMELIHARAAN = 'Selesai' ORDER BY p.TANGGAL_PENJADWALAN");
                                $a = 1;
                                while($row = mysqli_fetch_array($query)) {
                                ?>
                            <tr>
                                <td><?php echo $a; ?></td>
                                <td><?php echo $row['NAMA_ASET']; ?></td>
                                <td><?php echo $row['HASIL_PEMELIHARAAN']; ?></td>
                                <td><?php echo asRupiah($row['BIAYA_PEMELIHARAAN']); ?></td>
                                <td><?php echo tglIndo($row['TANGGAL_PENJADWALAN']); ?></td>
                                <td><?php echo tglIndo($row['TANGGAL_PEMELIHARAAN']); ?></td>
                                <!-- <td><?php echo tglIndo($row['SELESAI_PEMELIHARAAN']); ?></td> -->
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
                <button class="btn btn-success Filter" data-toggle="modal" data-target="#modal-filter" data-id="pemeliharaan"><i class="fa fa-search"></i> Filter</button>
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
                                <th>Jumlah Pemeliharaan</th>
                                <th>Biaya Pemeliharaan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>