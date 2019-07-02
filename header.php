<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>GKI</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>GKI</b>Sarpras</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <ul class="menu"> -->
                  <!-- <li>
                  <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo getcwd(); ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li> -->
                  <!-- end message -->
                  <!-- <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li> -->
          <!-- Notifications: style can be found in dropdown.less -->
          <?php
            $total = 0;
            if($_SESSION['role'] == "Peminjam" || $_SESSION['role'] == "Anggota MJ"){
              if($_SESSION['role'] == "Peminjam"){
                $query1 = mysqli_query($koneksi,"SELECT p.id_peminjaman, u.nama_lengkap, p.no_hp, p.keterangan_pinjam, p.tanggal_peminjaman, p.tanggal_pengajuan, p.hasil_pengajuan FROM peminjaman_aset p JOIN user u ON p.id_user = u.id_user WHERE p.status_peminjaman = 'Aktif' AND p.hasil_pengajuan != 'Pending' AND p.tanggal_peminjaman >= NOW() AND p.id_user = '".$_SESSION['id_user']."'");
                if (mysqli_num_rows($query1) > 0) {
                  $pinjam1 = mysqli_num_rows($query1);
                  $total = $total + 1;  
                }
              }
              if($_SESSION['role'] == "Anggota MJ"){
                $arr_peng = array();
                $arr_hapus = array();
                $no2 = 0;
                $no3 = 0;
                //$get = mysqli_fetch_array($_SESSION['notifikasi-pengadaan']);
                if(isset($_SESSION['notifikasi-pengadaan'])){
                  foreach ($_SESSION['notifikasi-pengadaan'] as $key => $select){
                    array_push($arr_peng, $select['id_pengadaan']);
                  }
                  $query = mysqli_query($koneksi, "SELECT * FROM pengadaan_aset WHERE ID_USER = '".$_SESSION['id_user']."' AND ID_PENGADAAN IN ( '".implode( "', '" , $arr_peng) . "')");
                  while($row1 = mysqli_fetch_array($query)){
                    if($row1['HASIL_APPROVAL'] != 'Pending'){
                      $no2 = $no2 + 1;
                    }
                  }
                }
                if(isset($_SESSION['notifikasi-penghapusan'])){
                  foreach ($_SESSION['notifikasi-penghapusan'] as $key => $select){
                    array_push($arr_hapus, $select['id_penghapusan']);
                  }
                  $query2 = mysqli_query($koneksi, "SELECT * FROM penghapusan_aset WHERE ID_USER = '".$_SESSION['id_user']."' AND ID_PENGHAPUSAN IN ( '" . implode( "', '" , $arr_hapus) . "'");
                  while($row2 = mysqli_fetch_array($query2)){
                    if($row2['HASIL_APPROVAL'] != 'Pending'){
                      $no3 = $no3 + 1;
                    }
                  }
                }
                //print_r($arr_peng);
                $query1 = mysqli_query($koneksi, "SELECT ID_ASET, TANGGAL_PENJADWALAN, DATE_SUB(TANGGAL_PENJADWALAN, INTERVAL NOTIF DAY) AS Batas FROM pemeliharaan_aset WHERE STATUS_PEMELIHARAAN = 'Aktif' HAVING Batas <= CURDATE() ORDER BY TANGGAL_PENJADWALAN ASC");
                
                if (mysqli_num_rows($query1) > 0) {
                  //$row1 = mysqli_fetch_array($query1);
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
              if ($total > 0) {
          ?>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" id="notif" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span id="notif_count" class="label label-danger">
                <?php echo $total; ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda memiliki <?php echo $total; ?> notifikasi</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <!-- <li>
                    <a href="pengadaan/">
                      <i class="fa fa-shopping-cart text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li> -->
                  <?php if(isset($pinjam1)) { ?>
                  <li>
                    <a href="#">
                      <i class="fa fa-edit text-blue"></i> Notifikasi pengajuan peminjaman aset
                    </a>
                  </li>
                  <?php } 
                  if(isset($no1)) { 
                    ?>
                  <li>
                    <a href="pemeliharaan/">
                      <i class="fa fa-gears text-green"></i> <?php echo $no1; ?> pengingat pemeliharaan aset 
                    </a>
                  </li>
                  
                  <?php } 
                  if(isset($no2) && $no2 != 0) { 
                    ?>
                  <li>
                    <a href="pengadaan/">
                      <i class="fa fa-shopping-cart text-blue"></i> <?php echo $no2; ?> pengajuan pengadaan aset 
                    </a>
                  </li>
                  
                  <?php } 
                  if(isset($no3) && $no3 != 0) { 
                    ?>
                  <li>
                    <a href="penghapusan/">
                      <i class="fa fa-trash text-red"></i> <?php echo $no3; ?> pengajuan penghapusan aset 
                    </a>
                  </li>
                  <?php } ?>
                  <!-- <li>
                    <a href="penghapusan/">
                      <i class="fa fa-trash text-red"></i> You changed your username
                    </a>
                  </li> -->
                </ul>
              </li>
              <!-- <li class="footer"><a href="#">View all</a></li> -->
            </ul>
          </li>
          <?php
            }
          }
          ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['nama_user']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <p>
                  <?php echo $_SESSION['nama_user']; ?>
                </p>
                <b><?php echo $_SESSION['role']; ?></b>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a role="button" class="btn btn-danger btn-flat logout">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>