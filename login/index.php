<?php 
	include "../connection.php"; 
	$dir = basename(__DIR__);
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php echo loadKonfigurasi("nama_web"); ?></title>
	<link rel="icon" href="<?php if ($dir != $root_folder) echo "../"; ?>gambar/konfig/<?php echo loadKonfigurasi("logo_icon"); ?>">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../dist/css/AdminLTE.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="../plugins/iCheck/all.css">
	<!-- <meta name="google-signin-scope" content="profile email"> -->
	<!-- <meta name="google-signin-client_id" content="268524586141-8as92crhk19mnj9ppak38ghjqo2k5dn4.apps.googleusercontent.com"> -->
	<!-- <script src="https://apis.google.com/js/platform.js" async defer></script> -->
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
		body {
			background-image: url("GKI-Sidoarjo-Baru-ok.jpg");
			background-size: cover;
			background-repeat: no-repeat;
			/* height: 100%; */
			background-color: grey;
			background-blend-mode: soft-light;
		}
		/* .g-signin2 {
		width: 100%;
		} */
		.g-signin2 > div {
			margin: 0 auto;
		}
		.login-box{
			margin: auto;
			padding-top: 8rem;
		}
	</style>
	</head>
	<body class="">
		<div class="login-box">
			<div class="login-logo">
				<a href="#"><b>GKI</b>Sarpras</a>
			</div>

			<div class="login-box-body">
				<?php
				if (isset($_GET['error'])) {
				?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fa fa-ban"></i> Kombinasi username/password salah
				</div>
				<?php
				}
				?>
				<?php
				if (isset($_GET['no-input'])) {
				?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fa fa-ban"></i> Username/password tidak boleh kosong
				</div>
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
					<div class="col-sm-8 col-xs-12">
						<div class="form-group">
							<input type="checkbox" class="minimal" id="password_check"> Show password
						</div>
					</div>
					
					<div class="col-sm-4 col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div> 
				</div>
				<!-- <div class="row">
					<div class="col-xs-12">
						<center><b>or Login using</b></center>
						<div style="margin:10px;" class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
					</div>
				</div> -->
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

	/* function onSignIn(googleUser) {
		// Useful data for your client-side scripts:
		var profile = googleUser.getBasicProfile();
		console.log("ID: " + profile.getId()); // Don't send this directly to your server!
		console.log('Full Name: ' + profile.getName());
		console.log('Given Name: ' + profile.getGivenName());
		console.log('Family Name: ' + profile.getFamilyName());
		console.log("Image URL: " + profile.getImageUrl());
		console.log("Email: " + profile.getEmail());

		// The ID token you need to pass to your backend:
		var id_token = googleUser.getAuthResponse().id_token;
		console.log("ID Token: " + id_token);

		$.ajax({
			type: 'POST',
			url: 'login_google.php',
			data: {id: profile.getId(), nama: profile.getName(), email: profile.getEmail(), gambar: profile.getImageUrl()}
		}).done(function(data){
			console.log(data);
			window.location.href = '../';
		}).fail(function() { 
			alert( "Posting failed." );
		});

		if(profile){
		
		}
	} */
	</script>
	</body>
</html>
