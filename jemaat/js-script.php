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

  $('#exampleAjax').DataTable({
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
        datatable: true
      }
    },
    "deferRender": true,
    "aLengthMenu": [10, 20, 50], // Combobox Limit
    "columns": [{
        "data": "no_induk",
        "render": function (data, type, row) {
          return row.no_induk == null ? '-' : row.no_induk.padStart(6, '0');
        }
      },
      {
        "data": "nama_lengkap"
      },
      {
        "data": "kelompok_jemaat"
      },
      {
        "data": "jenis_kelamin",
        "render": function (data, type, row) { // Tampilkan jenis kelamin
          var html = ""
          if (row.jenis_kelamin == 'L') { // Jika jenis kelaminnya L
            html = 'Laki-laki' // Set laki-laki
          } else { // Jika bukan L
            html = 'Perempuan' // Set perempuan
          }
          return html; // Tampilkan jenis kelaminnya
        }
      },
      {
        "data": "no_telp"
      }, // Tampilkan telepon
      {
        "data": "alamat"
      }, // Tampilkan alamat
      {
        "render": function (data, type, row) { // Tampilkan kolom aksi
          var html =
            '<button class="btn btn-warning modalLink" data-toggle="modal" data-target="#modal-test" data-id="' +
            row.id_jemaat + '"><i class="fa fa-pencil"></i> Edit</button>'
          //html += "<a href=''>DELETE</a>"
          return html
        }
      },
    ],
  });

  $('#exampleAjax').on('click', '.modalLink', function () {
    var value = $(this).data('id');
    $.ajax({
      url: 'ajax.php',
      type: 'POST',
      data: {
        id_jemaat: value
      },
      success: function (result) {
        console.log(result)
      }
    })
  })

  $('#checkbox_pinjam').iCheck({
    checkboxClass: 'icheckbox_minimal-green',
    radioClass: 'iradio_minimal-green'
  });
  /* $('#modal-default').on('shown', function () {
  // initialize iCheck
    
  }) */


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
        }).then(function () {
          window.location.href = "../logout.php";
          //return false;
        })
      }
    })
  });
</script>