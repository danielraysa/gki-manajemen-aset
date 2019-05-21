<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-success">
            <div class="box-header">
                <!-- <h3 class="box-title">Daftar Usulan Pengadaan Aset</h3> -->
                <button class="btn btn-success Filter" data-toggle="modal" data-target="#modal-filter" data-id="penghapusan"><i class="fa fa-search"></i> Filter</button>
                <!-- <button class="btn btn-warning Print" data-id="pengadaan"><i class="fa fa-print"></i> Cetak</button> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-hover table-responsive" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Aset</th>
                            <th>Pengusul</th>
                            <th>Tanggal Usulan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = mysqli_query($koneksi,"SELECT p.id_penghapusan, d.kode_aset, d.nama_aset, u.nama_lengkap, p.keterangan_penghapusan, p.tanggal_usulan, p.hasil_approval FROM penghapusan_aset p JOIN detil_usulan_penghapusan dp ON p.id_penghapusan = dp.id_penghapusan JOIN user u ON p.id_user = u.id_user JOIN daftar_aset d ON d.id_aset = dp.id_aset WHERE p.hasil_approval = 'Diterima'");
                            $a = 1;
                            while($row = mysqli_fetch_array($query)) {
                            ?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><?php echo $row['nama_aset']; ?></td>
                            <td><?php echo $row['nama_lengkap']; ?></td>
                            <td><?php echo tglIndo($row['tanggal_usulan']); ?></td>
                            <td><?php echo $row['keterangan_penghapusan']; ?></td>
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