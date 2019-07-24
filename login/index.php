<?php include "../connection.php"; $dir = basename(__DIR__); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title><?php echo loadKonfigurasi("nama_web"); ?></title>
  <link rel="icon" href="<?php if ($dir != "gki-sarpras") echo "../"; ?>gambar/konfig/<?php echo loadKonfigurasi("logo_icon"); ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/all.css">

  

  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
  <style>
    /* source-sans-pro-regular - latin */
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 400;
      src: url('../fonts/source-sans-pro-v12-latin-regular.eot'); /* IE9 Compat Modes */
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'),
          url('../fonts/source-sans-pro-v12-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
          url('../fonts/source-sans-pro-v12-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
          url('../fonts/source-sans-pro-v12-latin-regular.woff') format('woff'), /* Modern Browsers */
          url('../fonts/source-sans-pro-v12-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
          url('../fonts/source-sans-pro-v12-latin-regular.svg#SourceSansPro') format('svg'); /* Legacy iOS */
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>GKI</b>Sarpras</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php
    if (isset($_GET['error'])) {
      ?>
    <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon fa fa-ban"></i>
    Kombinasi username/password salah</div>
    <?php
    }
    ?>
    <?php
    if (isset($_GET['no-input'])) {
      ?>
    <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon fa fa-ban"></i>
    Username/password tidak boleh kosong</div>
    <?php
    }
    ?>
    <p class="login-box-msg">Sign in to start your session</p>
    <form action="login-check.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="pwd" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="form-group">
            <input type="checkbox" class="minimal" id="password_check"> Show password
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../plugins/iCheck/icheck.min.js"></script>

<script>
  $('#password_check').iCheck({
    checkboxClass: 'icheckbox_minimal-green',
    radioClass   : 'iradio_minimal-green'
  });
  $('#password_check').on('ifChecked', function(){
    $('#pwd').prop('type', 'text');
  });
  $('#password_check').on('ifUnchecked', function(){
    $('#pwd').prop('type', 'password');
  });
</script>
</body>
</html>
