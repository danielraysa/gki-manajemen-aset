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
        <li class="<?php if ($dir == "gki-sarpras") echo "active"; ?>">
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
            <li><a href="../merk/"><i class="fa fa-industry text-aqua"></i> Merk</a></li>
            <li><a href="../ruangan/"><i class="fa fa-map-o text-blue"></i> Ruangan</a></li>
            <li><a href="../komisi/"><i class="fa fa-group text-green"></i> Komisi</a></li>
            <li><a href="../status/"><i class="fa fa-refresh text-teal"></i> Status</a></li>
            <li><a href="../user/"><i class="fa fa-user text-red"></i> User</a></li>
          </ul>
        </li>
        <li class="<?php if ($dir == "aset") echo "active"; ?>">
          <a href="../aset/">
            <i class="fa fa-barcode"></i> <span>Daftar Aset</span>
          </a>
        </li>
        <li class="<?php if ($dir == "pengadaan") echo "active"; ?>">
          <a href="../pengadaan/">
            <i class="fa fa-cart-plus text-yellow"></i> <span>Pengadaan Aset</span>
          </a>
        </li>
        <li>
        <li class="<?php if ($dir == "peminjaman") echo "active"; ?>">
          <a href="../peminjaman/">
            <i class="fa fa-edit text-teal"></i> <span>Peminjaman Aset</span>
          </a>
        </li>
        <li class="<?php if ($dir == "pemeliharaan") echo "active"; ?>">
          <a href="../pemeliharaan/">
            <i class="fa fa-wrench text-lime"></i> <span>Pemeliharaan Aset</span>
          </a>
        </li>
        <li class="<?php if ($dir == "penghapusan") echo "active"; ?>">
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
          <a href="../pengadaan/">
            <i class="fa fa-cart-plus text-yellow"></i> <span>Pengadaan Aset</span>
          </a>
        </li>

        <li>
          <a href="../penghapusan/">
            <i class="fa fa-trash text-red"></i> <span>Penghapusan Aset</span>
          </a>
        </li>
        <li class="treeview <?php if ($dir == "laporan") echo "active"; ?>">
          <a href="#">
            <i class="fa fa-file-text-o"></i> <span>Laporan</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="laporan/?pengadaan"><i class="fa fa-cart-plus text-orange"></i> Pengadaan Aset</a></li>
            <li><a href="laporan/?peminjaman"><i class="fa fa-edit text-blue"></i> Peminjaman Aset</a></li>
            <li><a href="laporan/?pemeliharaan"><i class="fa fa-gears text-green"></i> Pemeliharaan Aset</a></li>
            <li><a href="laporan/?penghapusan"><i class="fa fa-gears text-red"></i> Penghapusan Aset</a></li>
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
        <li class="<?php if ($dir == "gki-sarpras") echo "active"; ?>">
          <a href="../index.php">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li class="<?php if ($dir == "peminjaman") echo "active"; ?>">
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