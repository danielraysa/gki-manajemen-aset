
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
    
    $('#example1').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'responsive': true,
        "scrollX": true
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