<!-- <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box">
        <div class="box-header">
            
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-hover table-responsive" width="100%">
            <thead>
            <tr>
                <th>No.</th>
                <th>Kode Aset</th>
                <th>Nama Aset</th>
                <th>Merk</th>
                <th>Harga Beli</th>
                <th>Tanggal Beli</th>
                <th>Ruangan</th>
                <th>Komisi</th>
                <th>Masa Manfaat</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.KODE_ASET, d.NAMA_ASET, m.NAMA_MERK, d.HARGA_PEMBELIAN, d.TANGGAL_PEMBELIAN, r.NAMA_RUANGAN, k.NAMA_KOMISI, d.MASA_MANFAAT, d.STATUS_ASET FROM daftar_aset d JOIN merk m ON d.ID_MERK = m.ID_MERK JOIN ruangan r ON d.ID_RUANGAN = r.ID_RUANGAN JOIN komisi_jemaat k ON d.ID_KOMISI = k.ID_KOMISI");
                $a = 1;
                while($row = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $row['KODE_ASET']; ?></td>
                    <td><?php echo $row['NAMA_ASET']; ?></td>
                    <td><?php echo $row['NAMA_MERK']; ?></td>
                    <td><?php echo str_replace(',','.',asRupiah($row['HARGA_PEMBELIAN'])); ?></td>
                    <td><?php echo $row['TANGGAL_PEMBELIAN']; ?></td>
                    <td><?php echo $row['NAMA_RUANGAN']; ?></td>
                    <td><?php echo $row['NAMA_KOMISI']; ?></td>
                    <td><?php echo $row['MASA_MANFAAT']; ?> tahun</td>
                    <td><?php echo $row['STATUS_ASET']; ?></td>
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
</div> -->

<div id="detil">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="box box-success">
                <div class="box-header">
                    <!-- <h3 class="box-title">Daftar Usulan Pengadaan Aset</h3> -->
                    <button class="btn btn-success Filter" data-toggle="modal" data-target="#modal-filter" data-id="pengadaan"><i class="fa fa-search"></i> Filter</button>
                    <!-- <button class="btn btn-warning Print" data-id="pengadaan"><i class="fa fa-print"></i> Cetak</button> -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover table-responsive" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Aset Usulan</th>
                                <th>Pengusul</th>
                                <!-- <th>Tanggal Usulan</th> -->
                                <th>Tanggal Pembelian</th>
                                <th>Nilai Beli</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = mysqli_query($koneksi,"SELECT p.id_pengadaan, d.id_aset, d.nama_aset, u.nama_lengkap, p.keterangan_usulan, p.tanggal_usulan, p.hasil_approval, d.harga_pembelian, d.tanggal_pembelian FROM pengadaan_aset p JOIN detil_usulan_pengadaan dp ON p.id_pengadaan = dp.id_pengadaan JOIN user u ON p.id_user = u.id_user JOIN daftar_aset d ON d.id_usulan_tambah = dp.id_usulan_tambah WHERE p.hasil_approval = 'Diterima' ORDER BY d.tanggal_pembelian");
                                $a = 1;
                                while($row = mysqli_fetch_array($query)) {
                                ?>
                            <tr>
                                <td><?php echo $a; ?></td>
                                <td><?php echo $row['nama_aset']; ?></td>
                                <td><?php echo $row['nama_lengkap']; ?></td>
                                
                                <!-- <td><?php echo tglIndo($row['tanggal_usulan']); ?></td> -->
                                <td><?php echo tglIndo($row['tanggal_pembelian']); ?></td>
                                <td><?php echo asRupiah($row['harga_pembelian']); ?></td>
                                <td><?php echo $row['keterangan_usulan']; ?></td>
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
                <button class="btn btn-success Filter" data-toggle="modal" data-target="#modal-filter" data-id="pengadaan"><i class="fa fa-search"></i> Filter</button>
            </div>
            <div class="box-body">
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div id="chart_box">
                        <canvas id="myChartA" height="400px"></canvas>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <table id="ringkas" class="table table-bordered table-hover table-responsive" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Aset</th>
                                <th>Jumlah</th>
                                <th>Total Biaya Pengadaan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>