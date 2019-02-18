<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['login_user']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Data Master</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../UI/general.html"><i class="fa fa-circle-o"></i> Sarana Prasarana</a></li>
            <li><a href="../UI/icons.html"><i class="fa fa-circle-o"></i> Jenis Barang</a></li>
            <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Ruangan</a></li>
            <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Komisi</a></li>
            <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Mutasi Barang</a></li>
          </ul>
        </li>
        <li>
          <a href="../mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Peminjaman</span>
          </a>
        </li>
        <li>
          <a href="../mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Perawatan</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Laporan</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="data.html"><i class="fa fa-circle-o"></i> Histori Peminjaman</a></li>
            <li><a href="data.html"><i class="fa fa-circle-o"></i> Histori Mutasi Lokasi</a></li>
            <li><a href="data.html"><i class="fa fa-circle-o"></i> Perawatan Sarana Prasarana</a></li>
          </ul>
        </li>
        <li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>