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
<!-- date-range-picker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- InputMask -->
<script src="../plugins/input-mask/jquery.inputmask.bundle.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-green',
    radioClass   : 'iradio_minimal-green'
  });
  $('#notif').on('click', function(){
    $('#notif_count').hide();
    <?php unset($_SESSION['notif']); ?>
  });
  $('.item-notif').on('click', function(){
    var id = "<?php echo $_SESSION['id_user']; ?>";
    var tabel = $(this).attr('id');
    $.ajax({
      url: "notif-data.php",
      type: "POST",
      data: {id_notif: id, tabel: tabel},
      success: function (result) {
        console.log(result)
      }
    });
  });
</script>
<script src="function.js"></script>