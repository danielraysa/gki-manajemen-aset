<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php if ($dir != "gki-sarpras") echo "../"; ?>gambar/konfig/<?php echo loadKonfigurasi("logo_web"); ?>" height="50px"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php if ($dir != "gki-sarpras") echo "../"; ?>gambar/konfig/<?php echo loadKonfigurasi("logo_web"); ?>" height="50px"> <?php echo loadKonfigurasi("nama_web"); ?></span>
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
          <?php include "notification.php"; ?>
          <!-- <div id="notification_content"></div> -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php if ($dir != "gki-sarpras") echo "../"; ?>gambar/user/<?php if($_SESSION['foto_user'] == "") echo "user2-160x160.jpg"; else echo $_SESSION['foto_user']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['nama_user']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php if ($dir != "gki-sarpras") echo "../"; ?>gambar/user/<?php if($_SESSION['foto_user'] == "") echo "user2-160x160.jpg"; else echo $_SESSION['foto_user']; ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo $_SESSION['nama_user']; ?>
                </p>
                <b><?php echo $_SESSION['role']; ?></b>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <button role="button" onclick="location.href = '<?php if ($dir != 'gki-sarpras') echo '../'; ?>profil/';" class="btn btn-primary btn-flat">Profil</button>
                </div>
                <div class="pull-right">
                  <button role="button" class="btn btn-danger btn-flat logout">Keluar</button>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>