<li class="dropdown notifications-menu">
    <!-- Notifications: style can be found in dropdown.less -->
    <?php
        $total = 0;
        if($_SESSION['role'] == "Peminjam" || $_SESSION['role'] == "Anggota MJ" || $_SESSION['role'] == "Ketua MJ"){
            if($_SESSION['role'] == "Peminjam"){
            $notif_peminjaman = mysqli_query($koneksi, "SELECT n.ID_NOTIF, p.ID_PEMINJAMAN, n.TGL_NOTIF, n.READ_NOTIF FROM notifikasi n JOIN peminjaman_aset p ON n.ID_REF = p.ID_PEMINJAMAN WHERE n.TABEL_REF = 'peminjaman_aset' AND p.ID_USER = '".$_SESSION['id_user']."' AND n.READ_NOTIF = 0");
            //$query1 = mysqli_query($koneksi,"SELECT p.id_peminjaman, u.nama_lengkap, p.no_hp, p.keterangan_pinjam, p.tanggal_peminjaman, p.tanggal_pengajuan, p.hasil_pengajuan FROM peminjaman_aset p JOIN user u ON p.id_user = u.id_user WHERE p.status_peminjaman = 'Aktif' AND p.hasil_pengajuan != 'Pending' AND p.tanggal_peminjaman >= NOW() AND p.id_user = '".$_SESSION['id_user']."'");
            /* if (mysqli_num_rows($query1) > 0) {
                $pinjam1 = mysqli_num_rows($query1);
                $total = $total + 1;  
            } */
            if (mysqli_num_rows($notif_peminjaman) > 0) {
                $pinjam1 = mysqli_num_rows($notif_peminjaman);
                $total = $pinjam1;  
            }
            }
            if($_SESSION['role'] == "Anggota MJ"){
            $notif_pengadaan = mysqli_query($koneksi, "SELECT n.ID_NOTIF, p.ID_PENGADAAN, n.TGL_NOTIF, n.READ_NOTIF FROM notifikasi n JOIN pengadaan_aset p ON n.ID_REF = p.ID_PENGADAAN WHERE n.TABEL_REF = 'pengadaan_aset' AND p.ID_USER = '".$_SESSION['id_user']."' AND n.READ_NOTIF = 0");
            $notif_penghapusan = mysqli_query($koneksi, "SELECT n.ID_NOTIF, p.ID_PENGHAPUSAN, n.TGL_NOTIF, n.READ_NOTIF FROM notifikasi n JOIN penghapusan_aset p ON n.ID_REF = p.ID_PENGHAPUSAN WHERE n.TABEL_REF = 'penghapusan_aset' AND p.ID_USER = '".$_SESSION['id_user']."' AND n.READ_NOTIF = 0");
            $arr_peng = array();
            $arr_hapus = array();
            $no2 = mysqli_num_rows($notif_pengadaan);
            $no3 = mysqli_num_rows($notif_penghapusan);
            
            //print_r($arr_peng);
            $query1 = mysqli_query($koneksi, "SELECT ID_ASET, TANGGAL_PENJADWALAN, DATE_SUB(TANGGAL_PENJADWALAN, INTERVAL NOTIF DAY) AS Batas FROM pemeliharaan_aset WHERE STATUS_PEMELIHARAAN = 'Aktif' HAVING Batas <= CURDATE() ORDER BY TANGGAL_PENJADWALAN ASC");
            
            if (mysqli_num_rows($query1) > 0) {
                $no1 = mysqli_num_rows($query1);
                $total = $total + 1;
            }
            if ($no2 != 0) {
                $total = $total + 1;
            }
            if ($no3 != 0) {
                $total = $total + 1;
            }
            }
            if($_SESSION['role'] == "Ketua MJ"){
            $notif_approval = mysqli_query($koneksi, "SELECT * FROM pengadaan_aset WHERE hasil_approval = 'Pending'");
            $notif_approval2 = mysqli_query($koneksi, "SELECT * FROM penghapusan_aset WHERE hasil_approval = 'Pending'");
            if (mysqli_num_rows($notif_approval) > 0) {
                $approval = mysqli_num_rows($notif_approval);
                $total = $total+$approval;
            }
            if (mysqli_num_rows($notif_approval2) > 0) {
                $approval2 = mysqli_num_rows($notif_approval2);
                $total = $total+$approval2;
            }
            }
            if ($total > 0) {
        ?>
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" id="notif" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <?php if(isset($_SESSION['notif'])) { ?>
        <span id="notif_count" class="label label-danger">
            <?php echo $total; ?>
        </span>
        <?php } ?>
    </a>
    <ul class="dropdown-menu">
        <li class="header">Anda memiliki <?php echo $total; ?> notifikasi</li>
        <li>
            <ul class="menu">
                <?php if(isset($pinjam1)) { ?>
                <li class="item-notif" id="peminjaman">
                    <a href="#">
                        <i class="fa fa-edit text-blue"></i> <?php echo $pinjam1; ?> pengajuan peminjaman aset
                    </a>
                </li>
                <?php } 
                  if(isset($no1)) { 
                    ?>
                <li class="item-notif" id="pemeliharaan">
                    <a href="#">
                        <i class="fa fa-gears text-green"></i> <?php echo $no1; ?> pengingat pemeliharaan aset
                    </a>
                </li>

                <?php } 
                  if(isset($no2) && $no2 != 0) { 
                    ?>
                <li class="item-notif" id="pengadaan">
                    <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>pengadaan/">
                        <i class="fa fa-shopping-cart text-blue"></i> <?php echo $no2; ?> pengajuan pengadaan aset
                    </a>
                </li>

                <?php } 
                  if(isset($no3) && $no3 != 0) {
                    ?>
                <li class="item-notif" id="penghapusan">
                    <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>penghapusan/">
                        <i class="fa fa-trash text-red"></i> <?php echo $no3; ?> pengajuan penghapusan aset
                    </a>
                </li>
                <?php } ?>

                <?php
                  if(isset($approval) && $approval != 0) { 
                    ?>
                <li class="item-notif" >
                    <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>pengadaan/">
                        <i class="fa fa-shopping-cart text-blue"></i> <?php echo $approval; ?> pengajuan pengadaan aset
                    </a>
                </li>

                <?php } 
                  if(isset($approval2) && $approval2 != 0) {
                    ?>
                <li class="item-notif" >
                    <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>penghapusan/">
                        <i class="fa fa-trash text-red"></i> <?php echo $approval2; ?> pengajuan penghapusan aset
                    </a>
                </li>
                <?php } ?>
            </ul>
        </li>
    </ul>
</li>
<?php
            }
          }
          ?>