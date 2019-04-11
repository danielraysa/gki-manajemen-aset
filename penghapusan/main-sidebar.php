<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nama_user']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php
      // Anggota MJ
      if($_SESSION['role'] == "Anggota MJ") {
      ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="../index.php">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop text-red"></i>
            <span>Data Master</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../barang/"><i class="fa fa-tv text-red"></i> Barang</a></li>
            <li><a href="../kategori/"><i class="fa fa-cubes text-yellow"></i> Kategori Barang</a></li>
            <li><a href="../ruangan/"><i class="fa fa-map-o text-blue"></i> Ruangan</a></li>
            <li><a href="../komisi/"><i class="fa fa-group text-green"></i> Komisi</a></li>
            <li><a href="../status/"><i class="fa fa-refresh text-teal"></i> Status</a></li>
            <li><a href="../user/"><i class="fa fa-user text-red"></i> User</a></li>
          </ul>
        </li>
        <li>
          <a href="../aset/">
            <i class="fa fa-barcode"></i> <span>Daftar Aset</span>
          </a>
        </li>
        <li>
          <a href="../pengadaan/">
            <i class="fa fa-cart-plus text-yellow"></i> <span>Pengadaan Aset</span>
          </a>
        </li>
        <li>
        <li>
          <a href="../peminjaman/approval.php">
            <i class="fa fa-edit text-teal"></i> <span>Peminjaman</span>
          </a>
        </li>
        <li>
          <a href="../pemeliharaan/">
            <i class="fa fa-wrench text-lime"></i> <span>Pemeliharaan</span>
          </a>
        </li>
        <li>
          <a href="../penghapusan/">
            <i class="fa fa-trash text-red"></i> <span>Penghapusan Aset</span>
          </a>
        </li>
      </ul>
      <?php
      }
      // Ketua MJ
      if($_SESSION['role'] == "Ketua MJ") {
      ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="../index.php">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        
        <li>
          <a href="../aset/">
            <i class="fa fa-barcode"></i> <span>Daftar Aset</span>
          </a>
        </li>
        <li>
          <a href="../pengadaan/approval.php">
            <i class="fa fa-cart-plus text-yellow"></i> <span>Pengadaan Aset</span>
          </a>
        </li>

        <li>
          <a href="../penghapusan/approval.php">
            <i class="fa fa-trash text-red"></i> <span>Penghapusan Aset</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-text-o"></i> <span>Laporan</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../laporan/pengadaan.php"><i class="fa fa-area-chart text-red"></i> Histori Peminjaman</a></li>
            <li><a href="../laporan/peminjaman.php"><i class="fa fa-area-chart text-red"></i> Histori Peminjaman</a></li>
            <li><a href="../laporan/pemeliharaan.php"><i class="fa fa-clipboard text-green"></i> Histori Mutasi Lokasi</a></li>
            <li><a href="../laporan/penghapusan.php"><i class="fa fa-gears text-blue"></i> Perawatan Sarana Prasarana</a></li>
          </ul>
        </li>
        
      </ul>
      <?php
      }
      // Peminjam
      if($_SESSION['role'] == "Peminjam") {
      ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="../index.php">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li>
          <a href="../aset/">
            <i class="fa fa-barcode"></i> <span>Daftar Aset</span>
          </a>
        </li>
        <li>
          <a href="../peminjaman/">
            <i class="fa fa-edit text-teal"></i> <span>Peminjaman</span>
          </a>
        </li>
        
        
      </ul>
      <?php
      }
      ?>
    </section>
    <!-- /.sidebar -->
  </aside>