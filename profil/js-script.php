
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
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../plugins/iCheck/icheck.min.js"></script>
<!-- page script -->
<script>
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-green',
        radioClass   : 'iradio_minimal-green'
    });
    $('#notif').on('click', function(){
        $('#notif_count').hide();
        
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
    $('#change_pass').on('ifChecked', function(event){
        //$('#nama').show();
        $('#pass').prop("disabled", false);
        $('#ulang_pass').prop("disabled", false);
    });
    $('#change_pass').on('ifUnchecked', function(event){
        //$('#nama').show();
        $('#pass').prop("disabled", true);
        $('#ulang_pass').prop("disabled", true);
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