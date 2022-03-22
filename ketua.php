<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
            <?php
                // $query = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM daftar_aset WHERE STATUS_ASET = 'Aktif'");
                $query = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM daftar_baru WHERE STATUS_ASET = 'Aktif'");
                $fetch = mysqli_fetch_array($query);
                echo $fetch['jumlah'];
            ?></h3>

                <p>Total Aset</p>
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
                $query = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM pengadaan_aset WHERE HASIL_APPROVAL = 'Pending'");
                $fetch = mysqli_fetch_array($query);
                echo $fetch['jumlah'];
            ?></h3>

                <p>Pengajuan Pengadaan Aset</p>
            </div>
            <div class="icon">
                <i class="fa fa-question-circle"></i>
            </div>
            <a href="pengadaan/" class="small-box-footer">
                Info lanjut <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
            <?php
                $query = mysqli_query($koneksi, "SELECT COUNT(d.ID_ASET) as jumlah FROM detail_peminjaman d JOIN peminjaman_aset p ON d.ID_PEMINJAMAN = p.ID_PEMINJAMAN WHERE p.HASIL_PENGAJUAN = 'Diterima' AND p.REALISASI_PENGEMBALIAN IS NULL");
                $fetch = mysqli_fetch_array($query);
                echo $fetch['jumlah'];
            ?></h3>

                <p>Aset Terpinjam</p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar"></i>
            </div>
            <a href="#" class="small-box-footer">
                Info lanjut <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
            <?php
                $query = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM penghapusan_aset WHERE HASIL_APPROVAL = 'Pending'");
                $fetch = mysqli_fetch_array($query);
                echo $fetch['jumlah'];
            ?></h3>

                <p>Pengajuan Penghapusan Aset</p>
            </div>
            <div class="icon">
                <i class="fa fa-trash"></i>
            </div>
            <a href="penghapusan/" class="small-box-footer">
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
    <!-- <div class="col-lg-6 col-md-12 col-xs-12">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Jumlah Aset Tiap Komisi Jemaat</h3>
            </div>
            <div class="box-body">
                <canvas id="myChartA" height="400px"></canvas>
            </div>
        </div>
    </div> -->
</div>