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
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  
  <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  
  <!-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> -->

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
  .swal2-popup {
    font-size: 1.6rem !important;
  }
  </style>