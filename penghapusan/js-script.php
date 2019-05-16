<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- SweetAlert2 -->
<script src="../plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- date-picker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- InputMask -->
<script src="../plugins/input-mask/jquery.inputmask.bundle.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../plugins/iCheck/icheck.min.js"></script>
<script src="../node/iCheck/icheck.min.js"></script>
<script>
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-green',
    radioClass   : 'iradio_minimal-green'
  })
</script>
<!-- page script -->
<script src="function.js"></script>

<!-- Include the Fallback JS library.
<script src="fallback.js"></script> -->

<!-- // Script block to execute Fallback JS -->
<script>
/* 
	// Here we actually invoke Fallback JS to retrieve the following libraries for the page.
	fallback.load({
		// Include your stylesheets, this can be an array of stylesheets or a string!
		css: 'css-script.php',

		// JavaScript library. THE KEY MUST BE THE LIBRARIES WINDOW VARIABLE!
		JSON: '//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.min.js',

		// Here goes a failover example. The first will fail, therefore Fallback JS will load the second!
		jQuery: [
			'//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.FAIL_ON_PURPOSE.min.js',
			'//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js',
			'//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js'
		],

		'jQuery.ui': [
			'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js',
			'//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js',
			'//js/loader.js?i=vendor/jquery-ui.min.js'
		]
	}, {
		// Shim jQuery UI so that it will only load after jQuery has completed!
		shim: {
			'jQuery.ui': ['jQuery']
		},

		callback: function(success, failed) {
			// success - object containing all libraries that loaded successfully.
			// failed - object containing all libraries that failed to load.

			// All of my libraries have finished loading!

			// Execute my code that applies to all of my libraries here!
		}
	});

	fallback.ready(['jQuery'], function() {
		// jQuery Finished Loading

		// Execute my jQuery dependent code here!
	});

	fallback.ready(['jQuery', 'JSON'], function() {
		// jQuery and JSON Finished Loading

		// Execute my jQuery + JSON dependent code here!
	});

	fallback.ready(function() {
		// All of my libraries have finished loading!

		// Execute my code that applies to all of my libraries here!
	}); */
</script>