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
          <p><?php echo $_SESSION['login_user']; ?></p>
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
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="../">
          <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-laptop text-red"></i>
            <span>Data Master</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <?php $dir = basename(__DIR__); ?>
            <?php 
              if ($dir == "barang") {
              ?>
            <li class="active">
            <?php
              }
              else {
              ?>
                <li>
            <?php
              }
              ?>
            <a href="../barang/"><i class="fa fa-tv text-red"></i> Barang</a></li>
            <?php 
              if ($dir == "kategori") {
              ?>
            <li class="active">
            <?php
              }
              else {
              ?>
                <li>
            <?php
              }
              ?>
            <a href="../kategori/"><i class="fa fa-cubes text-yellow"></i> Kategori Barang</a></li>
            <?php 
              if ($dir == "ruangan") {
              ?>
            <li class="active">
            <?php
              }
              else {
              ?>
                <li>
            <?php
              }
              ?>
            <a href="../ruangan/"><i class="fa fa-map-o text-blue"></i> Ruangan</a></li>
            <?php 
              if ($dir == "komisi") {
              ?>
            <li class="active">
            <?php
              }
              else {
              ?>
                <li>
            <?php
              }
              ?>
            <a href="../komisi/"><i class="fa fa-group text-green"></i> Komisi</a></li>
            <?php 
              if ($dir == "status") {
              ?>
            <li class="active">
            <?php
              }
              else {
              ?>
                <li>
            <?php
              }
              ?>
            <a href="../status/"><i class="fa fa-refresh text-teal"></i> Status</a></li>
            <?php 
              if ($dir == "user") {
              ?>
            <li class="active">
            <?php
              }
              else {
              ?>
                <li>
            <?php
              }
              ?>
            <a href="../user/"><i class="fa fa-user text-red"></i> User</a></li>
          </ul>
        </li>
        <?php 
          if ($dir == "aset") {
          ?>
        <li class="active">
        <?php
          }
          else {
          ?>
            <li>
        <?php
          }
          ?>
          <a href="../aset/">
            <i class="fa fa-barcode"></i> <span>Daftar Aset</span>
          </a>
        </li>
        <?php 
          if ($dir == "pengadaan") {
          ?>
        <li class="active">
        <?php
          }
          else {
          ?>
            <li>
        <?php
          }
          ?>
          <a href="../pengadaan/">
            <i class="fa fa-cart-plus text-yellow"></i> <span>Pengadaan Aset</span>
          </a>
        </li>
        <?php 
          if ($dir == "peminjaman") {
          ?>
        <li class="active">
        <?php
          }
          else {
          ?>
            <li>
        <?php
          }
          ?>
          <a href="../peminjaman/">
            <i class="fa fa-edit text-teal"></i> <span>Peminjaman</span>
          </a>
        </li>
        <?php 
          if ($dir == "maintenance") {
          ?>
        <li class="active">
        <?php
          }
          else {
          ?>
            <li>
        <?php
          }
          ?>
          <a href="../maintenance/">
            <i class="fa fa-wrench text-lime"></i> <span>Pemeliharaan</span>
          </a>
        </li>
        <?php 
          if ($dir == "penghapusan") {
          ?>
        <li class="active">
        <?php
          }
          else {
          ?>
            <li>
        <?php
          }
          ?>
          <a href="../penghapusan/">
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
            <li><a href="../laporan/histori-peminjaman/"><i class="fa fa-area-chart text-red"></i> Histori Peminjaman</a></li>
            <li><a href="../laporan/histori-mutasi/"><i class="fa fa-clipboard text-green"></i> Histori Mutasi Lokasi</a></li>
            <li><a href="../laporan/maintenance-sarpras/"><i class="fa fa-gears text-blue"></i> Perawatan Sarana Prasarana</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>