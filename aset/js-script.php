
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
<script src="../plugins/iCheck/icheck.min.js"></script>
<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $('.select2').select2();
  
  $('#example1').DataTable({
    'autoWidth': true,
    'responsive': true,
    'scrollX': true
  })

  var data_table = $('#tabelAset').DataTable({
    "processing": true,
    "serverSide": true,
    "ordering": true, // Set true agar bisa di sorting
    "order": [
      [0, 'asc'],
      [1, 'asc']
    ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
    "ajax": {
      "url": "ajax.php", // URL file untuk proses select datanya
      "type": "POST",
      "data": {
        datatable: true,
      }
    },
    // "deferRender": true,
    "aLengthMenu": [10, 20, 50], // Combobox Limit
    "columns": [
      {
        "data": "KODE_BARANG"
      },
      {
        "data": "NAMA_BARANG"
      },
      {
        "data": "NAMA_MERK"
      },
      {
        "data": "NAMA_LOKASI"
      },
      {
        "data": "NAMA_RUANGAN"
      },
      {
        "data": "STATUS_ASET"
      },
      {
        "data": "ID_ASET",
        "render": function (data) { // Tampilkan kolom aksi
          let html = '<button class="btn btn-warning modalLink" data-toggle="modal" data-target="#modal-test" data-id="' + data + '"><i class="fa fa-pencil"></i> Edit</button>'
          return html
        }
      },
    ],
  });

  $('#checkbox_pinjam').iCheck({
      checkboxClass: 'icheckbox_minimal-green',
      radioClass   : 'iradio_minimal-green'
    });
  /* $('#modal-default').on('shown', function () {
  // initialize iCheck
    
  }) */

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#gambar_aset').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgInp").change(function(){
    var input = $(this),
    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [label]);
      //alert(label);
      readURL(this);
  });

  // update with image
	$('#example1, #tabelAset').on('click','.modalLink', function(){
		var id = $(this).attr('data-id');
    console.log(id);
    $('#id_aset').val(id);
		$.ajax({
			url:"ajax.php",
			type: "POST",
			data: {ID: id},
			success:function(result){
        var data = JSON.parse(result);
				console.log(data)
        //$('#id_aset').val(id);
        $('#nama_aset').val(data.nama);
        $('#kode_aset').val(data.kode);
        $('#seri_model').val(data.seri);
        $('#lokasi_aset').val(data.lokasi);
        $("#lokasi_aset").select2("destroy").select2();
        $('#ruangan_aset').val(data.ruangan);
        $("#ruangan_aset").select2("destroy").select2();
        $('#merk_aset').val(data.merk);
        $("#merk_aset").select2("destroy").select2();
        // $('#komisi_aset').val(data.komisi);
        // $("#komisi_aset").select2("destroy").select2();
        if(data.foto != null && data.foto != '') {
          $('#gambar_aset').attr('src', '../gambar/aset/'+data.foto);
        }
        else {
          $('#gambar_aset').attr('src', '');
        }
			}
		});
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