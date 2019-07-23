
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
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script>
  /* function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#img-upload').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  } */
  $("#imgInp").change(function(){
      var input = $(this),
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [label]);
      //readURL(this);
      if (this.files && this.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#img-upload').attr('src', e.target.result);
          }
          reader.readAsDataURL(this.files[0]);
      }
  });
  $("#imgInp-2").change(function(){
      var input = $(this),
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [label]);
      //alert(label)
      //readURL(this);
      if (this.files && this.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#img-upload-2').attr('src', e.target.result);
          }
          reader.readAsDataURL(this.files[0]);
      }
  });
  
  $('.logout').on('click', function (event) {
      event.preventDefault();
      swal({
          title: 'Apakah anda ingin keluar?',
      type: 'warning',
      showCancelButton: true,
      //confirmButtonColor: '#d9534f',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
      }).then((result) => {
          if (result.value) {
              swal({
                  title: "Sukses",
                    text: "Harap tunggu sejenak.",
                  type: "success",
                  timer: 2000,
                  showConfirmButton: false
                  }).then(function(){
                      window.location.href = "../logout.php";
                      //return false;
                  })
              }
          }
      )
  });
</script>