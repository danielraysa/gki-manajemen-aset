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

  $('#checkbox_meninggal, #checkbox_keluar').iCheck({
    checkboxClass: 'icheckbox_minimal-green',
    radioClass: 'iradio_minimal-green'
  });

  var params = {
    'pekerjaan': 'Pekerjaan',
    'gol_darah': 'Golongan Darah',
    'kelompok_jemaat': 'Kelompok Jemaat',
    'tempat_lahir': 'Tempat Lahir',
    'tahun_lahir': 'Tahun Lahir',
    'atestasi_masuk_asal': 'Atestasi Masuk Asal'
  }
  for (const key in params) {
    if (Object.hasOwnProperty.call(params, key)) {
      const element = params[key];
      // console.log(element)
      $('#filter').append(`<option value="${key}">${element}</option>`)
    }
  }

  var data_table = $('#exampleAjax').DataTable({
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
        "data": "kelompok_jemaat"
      },
      {
        "data": "no_telp"
      },
      {
        "data": "alamat"
      },
      {
        "render": function (data, type, row) { // Tampilkan kolom aksi
          var html =
            '<button class="btn btn-warning modalLink" data-toggle="modal" data-target="#modal-form" data-id="' +
            row.id_jemaat + '"><i class="fa fa-pencil"></i> Edit</button>'
          return html
        }
      },
    ],
  });
  
  $('#exampleAjax').on('click', '.modalLink', function () {
    let value = $(this).data('id');
    load_first = false;
    $.ajax({
      url: 'ajax.php',
      type: 'POST',
      data: {id_jemaat: value},
      success: function (result) {
        console.log(result)
        $('#id_jemaat').val(result.id_jemaat)
        $('#no_induk').val(result.no_induk)
        $('#nama_lengkap').val(result.nama_lengkap)
        $('#jenis_kelamin').val(result.jenis_kelamin)
        $('#no_telp').val(result.no_telp)
        $('#alamat').val(result.alamat)
        $('#kelompok_jemaat').val(result.kelompok_jemaat).trigger('change')
        $('#tanggal_lahir').val(result.tanggal_lahir)
        $('#tempat_lahir').val(result.tempat_lahir)
        $('#baptis_tempat').val(result.baptis_tempat)
        $('#baptis_tanggal').val(result.baptis_tanggal)
        $('#sidi_tempat').val(result.sidi_tempat)
        $('#sidi_tanggal').val(result.sidi_tanggal)
        $('#email').val(result.email)
        $('#gol_darah').val(result.gol_darah)
        $('#pekerjaan').val(result.pekerjaan)
        $('#tanggal_pernikahan').val(result.tanggal_pernikahan)
        $('#atestasi_masuk_asal').val(result.atestasi_masuk_asal)
        $('#atestasi_masuk_tanggal').val(result.atestasi_masuk_tanggal)
        $('#atestasi_keluar_tujuan').val(result.atestasi_keluar_tujuan)
        $('#atestasi_keluar_tanggal').val(result.atestasi_keluar_tanggal)
        if(result.meninggal == "1" || result.status_meninggal != null){
          $('#tanggal_meninggal').val(result.tanggal_meninggal)
          $('#checkbox_meninggal').iCheck('check')
          $('#form-meninggal').show()
        }else{
          $('#checkbox_meninggal').iCheck('uncheck')
          $('#form-meninggal').hide()
        }
        if(result.keluar == "1"){
          $('#checkbox_keluar').iCheck('check')
        }else{
          $('#checkbox_keluar').iCheck('uncheck')
        }
      },
      error: function(e){
        console.log(e)
      }
    })
  })

  $('#search').click(function(){
    let new_param = $('#filter').val()
    let new_val = $('#filter_value').val()
    data_table.ajax.url(`ajax.php?filter=${new_param}&value=${new_val}`).load()
  })

  $('#reset').click(function(){
    $('#filter').val('')
    $('#filter_value').val('')
    data_table.ajax.url(`ajax.php`).load()
  })

  $('#btnTambah').click(function(){
    document.getElementById("formJemaat").reset();
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
        }).then(function () {
          window.location.href = "../logout.php";
          //return false;
        })
      }
    })
  });
</script>