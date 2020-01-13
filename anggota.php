<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
            <?php
                $query = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM daftar_aset WHERE STATUS_ASET = 'Aktif'");
                $fetch = mysqli_fetch_array($query);
                echo $fetch['jumlah'];
            ?></h3>

                <p>Total aset aktif</p>
            </div>
            <div class="icon">
                <i class="fa fa-television"></i>
            </div>
            <a href="aset/" class="small-box-footer">
                Info lanjut <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
            <?php
                //$query = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM peminjaman_aset WHERE HASIL_PENGAJUAN = 'Pending'");
                $query = mysqli_query($koneksi, "SELECT p.id_peminjaman, u.nama_lengkap, p.no_hp, p.keterangan_pinjam, p.tanggal_peminjaman, p.tanggal_pengajuan, p.hasil_pengajuan FROM peminjaman_aset p JOIN user u ON p.id_user = u.id_user WHERE p.status_peminjaman = 'Aktif' AND p.tanggal_peminjaman >= NOW() AND p.hasil_pengajuan = 'Pending'");
                //$fetch = mysqli_fetch_array($query);
                $fetch = mysqli_num_rows($query);
                echo $fetch;
            ?></h3>

                <p>Pengajuan peminjaman aset</p>
            </div>
            <div class="icon">
                <i class="fa fa-question-circle"></i>
            </div>
            <a href="peminjaman/" class="small-box-footer">
                Info lanjut <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-6">

        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
            <?php
                $query = mysqli_query($koneksi, "SELECT COUNT(d.ID_ASET) as jumlah FROM detail_peminjaman d JOIN peminjaman_aset p ON d.ID_PEMINJAMAN = p.ID_PEMINJAMAN WHERE p.HASIL_PENGAJUAN = 'Diterima' AND p.REALISASI_PENGEMBALIAN IS NULL");
                $fetch = mysqli_fetch_array($query);
                echo $fetch['jumlah'];
            ?></h3>

                <p>Aset terpinjam</p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar"></i>
            </div>
            <a href="peminjaman/" class="small-box-footer">
                Info lanjut <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
            <?php
                $query = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM pemeliharaan_aset p WHERE p.STATUS_PEMELIHARAAN = 'Aktif' AND p.TANGGAL_PENJADWALAN <= NOW()");
                $fetch = mysqli_fetch_array($query);
                echo $fetch['jumlah'];
                //$query = mysqli_query($koneksi,"SELECT COUNT(p.ID_PEMELIHARAAN), p.ID_ASET, d.KODE_ASET, d.NAMA_ASET, MIN(p.TANGGAL_PENJADWALAN) as TANGGAL_PENJADWALAN, p.BATAS_PENJADWALAN FROM pemeliharaan_aset p LEFT OUTER JOIN daftar_aset d ON p.ID_ASET = d.ID_ASET WHERE p.STATUS_PEMELIHARAAN = 'Aktif' AND p.TANGGAL_PENJADWALAN <= NOW() GROUP BY p.ID_ASET");
                //$rows = mysqli_num_rows($query);
                //echo $rows;
            ?></h3>

                <p>Pemeliharaan aset tertunda</p>
            </div>
            <div class="icon">
                <i class="fa fa-gears"></i>
            </div>
            <a href="pemeliharaan/" class="small-box-footer">
                Info lanjut <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
<!-- Info boxes -->
<div class="row">
    <div class="col-lg-6 col-md-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Jumlah Aset per Tiap Ruangan</h3>
            </div>
            <div class="box-body">
                <canvas id="myChart" height="400px"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-xs-12">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Jumlah Aset Tiap Komisi Jemaat</h3>
            </div>
            <div class="box-body">
                <canvas id="myChartA" height="400px"></canvas>
            </div>
        </div>
    </div>
</div>