<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php if ($dir != "gki-sarpras") echo "../"; ?>gambar/user/<?php echo $_SESSION['foto_user']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nama_user']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
        /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php
      // Anggota MJ
      if($_SESSION['role'] == "Anggota MJ") {
      ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php if ($dir == "gki-sarpras") echo "active"; ?>">
          <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>index.php">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li class="treeview <?php if ($dir == "barang" || $dir == "kategori" || $dir == "merk" || $dir == "ruangan" || $dir == "komisi" || $dir == "status" || $dir == "user") echo "active"; ?>">
          <a href="#">
            <i class="fa fa-laptop text-red"></i>
            <span>Data Master</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($dir == "barang") echo "active"; ?>"><a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>barang/"><i class="fa fa-tv text-red"></i> Barang</a></li>
            <li class="<?php if ($dir == "kategori") echo "active"; ?>"><a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>kategori/"><i class="fa fa-cubes text-yellow"></i> Kategori Barang</a></li>
            <li class="<?php if ($dir == "merk") echo "active"; ?>"><a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>merk/"><i class="fa fa-industry text-aqua"></i> Merk</a></li>
            <li class="<?php if ($dir == "ruangan") echo "active"; ?>"><a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>ruangan/"><i class="fa fa-map-o text-blue"></i> Ruangan</a></li>
            <li class="<?php if ($dir == "komisi") echo "active"; ?>"><a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>komisi/"><i class="fa fa-group text-green"></i> Komisi</a></li>
            <li class="<?php if ($dir == "status") echo "active"; ?>"><a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>status/"><i class="fa fa-refresh text-teal"></i> Status</a></li>
            <li class="<?php if ($dir == "user") echo "active"; ?>"><a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>user/"><i class="fa fa-user text-red"></i> User</a></li>
          </ul>
        </li>
        <li class="<?php if ($dir == "aset") echo "active"; ?>">
          <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>aset/">
            <i class="fa fa-barcode"></i> <span>Daftar Aset</span>
          </a>
        </li>
        <li class="treeview <?php if ($dir == "pengadaan") echo "active"; ?>">
          <a href="#">
            <i class="fa fa-cart-plus text-yellow"></i> <span>Pengadaan Aset</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($file == "") echo "active"; ?>"><a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>pengadaan/"><i class="fa fa-tv text-red"></i> Usulan Pengadaan</a></li>
            <li class="<?php if ($file == "giveaway.php") echo "active"; ?>"><a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>pengadaan/giveaway.php"><i class="fa fa-cubes text-yellow"></i> Tambah dari Jemaat</a></li>
          </ul>
          <!-- <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>pengadaan/">
            <i class="fa fa-cart-plus text-yellow"></i> <span>Pengadaan Aset</span>
          </a> -->
        </li>
        <li class="<?php if ($dir == "peminjaman") echo "active"; ?>">
          <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>peminjaman/">
            <i class="fa fa-edit text-teal"></i> <span>Peminjaman Aset</span>
          </a>
        </li>
        <li class="<?php if ($dir == "pemeliharaan") echo "active"; ?>">
          <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>pemeliharaan/">
            <i class="fa fa-wrench text-lime"></i> <span>Pemeliharaan Aset</span>
          </a>
        </li>
        <li class="<?php if ($dir == "penghapusan") echo "active"; ?>">
          <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>penghapusan/">
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
        <li class="<?php if ($dir == "gki-sarpras") echo "active"; ?>">
          <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>index.php">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        
        <li class="<?php if ($dir == "aset") echo "active"; ?>">
          <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>aset/">
            <i class="fa fa-barcode"></i> <span>Daftar Aset</span>
          </a>
        </li>
        <li class="<?php if ($dir == "pengadaan") echo "active"; ?>">
          <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>pengadaan/">
            <i class="fa fa-cart-plus text-yellow"></i> <span>Pengadaan Aset</span>
          </a>
        </li>

        <li class="<?php if ($dir == "penghapusan") echo "active"; ?>">
          <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>penghapusan/">
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
            <li class="<?php if (isset($_GET['pengadaan'])) echo "active"; ?>"><a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>laporan/?pengadaan"><i class="fa fa-cart-plus text-orange"></i> Pengadaan Aset</a></li>
            <li class="<?php if (isset($_GET['peminjaman'])) echo "active"; ?>"><a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>laporan/?peminjaman"><i class="fa fa-edit text-blue"></i> Peminjaman Aset</a></li>
            <li class="<?php if (isset($_GET['pemeliharaan'])) echo "active"; ?>"><a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>laporan/?pemeliharaan"><i class="fa fa-gears text-green"></i> Pemeliharaan Aset</a></li>
            <li class="<?php if (isset($_GET['penghapusan'])) echo "active"; ?>"><a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>laporan/?penghapusan"><i class="fa fa-trash text-red"></i> Penghapusan Aset</a></li>
          </ul>
        </li>
        <li class="<?php if ($dir == "konfigurasi") echo "active"; ?>">
          <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>konfigurasi/">
            <i class="fa fa-gear"></i> <span>Konfigurasi</span>
          </a>
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
          <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>index.php">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li class="<?php if ($dir == "peminjaman") echo "active"; ?>">
          <a href="<?php if ($dir != "gki-sarpras") echo "../"; ?>peminjaman/">
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