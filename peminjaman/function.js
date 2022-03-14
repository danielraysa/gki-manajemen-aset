$('.select2').select2();
//$('.select2-selection').css('border-radius','0px')
$('[data-toggle="tooltip"]').popover();

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
      "data": "KODE_BARANG",
    },
    {
      "data": "NAMA_BARANG"
    },
    {
      "data": "MERK"
    },
    {
      "data": "LOKASI_BARANG"
    },
    {
      "data": "KOMISI"
    },
    /* {
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
    }, */
    {
      "render": function (data, type, row) { // Tampilkan kolom aksi
        let html = '<button type="button" data-id="' + row.ID_ASET + '" class="btn btn-success addPinjam"><i class="fa fa-plus"></i> Tambah ke Daftar Pinjam</button>'
        return html
      }
    },
  ],
});

var data_table_pinjam = $('#tabelPinjam').DataTable({
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
      pinjam: true,
    }
  },
  // "deferRender": true,
  "aLengthMenu": [10, 20, 50], // Combobox Limit
  "columns": [{
      "data": "KODE_BARANG",
    },
    {
      "data": "NAMA_BARANG"
    },
    {
      "data": "MERK"
    },
    {
      "render": function (data, type, row) { // Tampilkan kolom aksi
        let html = '<button type="button" data-id="' + row.ID_ASET + '" class="btn btn-danger btn-block remove"><i class="fa fa-trash"></i> Hapus</button>'
        return html
      }
    },
  ],
});

$('#example1').DataTable({
  'paging': true,
  'ordering': true,
  'info': true,
  'autoWidth': true,
  'scrollX': true,
  'responsive': true
});
$('#example2').DataTable({
  'paging': true,
  'ordering': true,
  'info': true,
  'autoWidth': true,
  'responsive': true,
  'scrollX': true,
  'responsive': true
});
var table4 = $('#example4').DataTable({
  'retrieve': true,
  'paging': true,
  'lengthChange': false,
  'searching': false,
  'ordering': true,
  'info': true,
  'autoWidth': true,
  'responsive': true,
  'pageLength': 5
});
var table5 = $('#example5').DataTable({
  'retrieve': true,
  'paging': true,
  'lengthChange': false,
  'searching': false,
  'ordering': true,
  'info': true,
  'autoWidth': true,
  'responsive': true,
  'pageLength': 5
});
var catat_tabel = $('#tabel_catatan').DataTable({
  'retrieve': true,
  'paging': true,
  'lengthChange': false,
  'searching': false,
  'ordering': true,
  'info': true,
  'autoWidth': true,
  'responsive': true,
  'pageLength': 5
});
//var table = $('#example').DataTable();

$('#reservation').daterangepicker({
  autoclose: true,
  locale: {
    format: 'DD/MM/YYYY'
  }
});

var picker_tglpinjam = $('#tgl_pinjam').daterangepicker({
  singleDatePicker: true,
  autoclose: true,
  locale: {
    format: 'DD/MM/YYYY'
  }
});
var picker_tglkembali = $('#tgl_kembali').daterangepicker({
  singleDatePicker: true,
  autoclose: true,
  locale: {
    format: 'DD/MM/YYYY'
  }
});

picker_tglpinjam.on('apply.daterangepicker', function(ev, picker) {
  console.log(picker.startDate.format('YYYY-MM-DD'));
  console.log(picker.endDate.format('YYYY-MM-DD'));
});
picker_tglkembali.on('apply.daterangepicker', function(ev, picker) {
  $('#tgl_kembali').val(picker.startDate.format('DD/MM/YYYY'));
  // console.log(picker.endDate.format('YYYY-MM-DD'));
});

$('#realisasi_pengembalian').datepicker({
  format: 'dd/mm/yyyy',
  autoclose: true
});

$('#nohp').keypress(function (e) {
  //if the letter is not digit then display error and don't type anything
  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
     //display error message
    $("#errmsg").html("Input berupa angka").show().fadeOut(2000);
    return false;
  }
});
function validationMessage() {
  //var inpObj = document.getElementById("id1");
  var inpObj = $(this).val();
  if (!inpObj.checkValidity()) {
    //document.getElementById("demo").innerHTML = inpObj.validationMessage;
    alert("Data tidak boleh kosong");
  }
}

$('.emptyData').on('click', function () {
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: {empty: true},
    success: function (result) {
      //console.log(id);
      location.reload();
    }
  });
});

$('#scan-id').on('keypress',function(e) {
  let id = $(this).val();
  if(e.which == 13) {
    $.ajax({
      url: "ajax.php",
      type: "POST",
      data: {add_pinjam: id},
      success: function (result) {
        console.log(result)
        data_table_pinjam.ajax.reload();
      }
    });
  }
  $(this).val('');
});

//Tambah Pinjam
$('#example1,#exampleAjax').on('click', '.addPinjam', function () {
  var id = $(this).attr('data-id');
  $.ajax({
    url: "ajax.php",
    type: "POST",
    // data: "add-pinjam=" + id,
    data: {add_pinjam: id},
    success: function (result) {
      // location.reload();
      // data_table.ajax.reload();
      data_table_pinjam.ajax.reload();
    }
  });
  $(this).parent().parent().remove();
});

//Hapus Item
$('#example1,#tabelPinjam').on('click', '.remove', function () {
  var id = $(this).attr('data-id');
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: {hapus_item: id},
    success: function (result) {
      //console.log(result);
      // location.reload();
      data_table.ajax.reload();
      data_table_pinjam.ajax.reload();
    }
  });
});
// Simpan Pinjam
$('#btnSimpan').click(function () {
  //var peminjam = $('#peminjam_aset').val();
  var komisi = $('#komisi_peminjam').val();
  var no_hp = $('#nohp').val();
  var tgl = $('#tgl_pinjam').val();
  var tgl2 = $('#tgl_kembali').val();
  var ket = $('#keterangan').val();
  //alert(peminjam+" / "+komisi+" / "+no_hp);
  //alert(komisi+" / "+no_hp);
  if(no_hp == '' || tgl == '' || ket == '') {
    swal({
      title: "Peringatan",
      text: "Data tidak boleh ada yang kosong.",
      type: "warning",
      timer: 2000,
      showConfirmButton: false
    });
  }
  else {
    $.ajax({
      url: "ajax.php",
      type: "POST",
      data: {
        simpan_pinjam: true,
        //id_peminjam: peminjam,
        id_komisi: komisi,
        no_hp: no_hp,
        tgl_pinjam: tgl,
        tgl_kembali: tgl2,
        keterangan: ket
      },
      success: function (result) {
        console.log(result);
        swal({
          title: "Sukses",
          text: "Data telah disimpan.",
          type: "success",
          timer: 2000,
          //confirmButtonText: '<a href="print_form.php?print_id='+result+'" target="_blank">Cetak form</a>'
          showConfirmButton: false
        }).then(function () {
          //window.location.href = 'print_form.php?print_id='+result; 
          //window.open('print_form.php?print_id='+result,'_blank'); // <- This is what makes it open in a new window.
          window.open('print_form.php','_blank');
          location.reload();
        });
      }
    });
  }
});
$('#btnUpdate').click(function () {
  var id = $('#id_peminjaman_edit').val();
  var komisi = $('#komisi_peminjam').val();
  var no_hp = $('#nohp').val();
  var tgl = $('#reservation').val();
  var ket = $('#keterangan').val();
  //alert(peminjam+" / "+komisi+" / "+no_hp);
  //alert(komisi+" / "+no_hp);
  if(no_hp == '' || tgl == '' || ket == '') {
    swal({
      title: "Peringatan",
      text: "Data tidak boleh ada yang kosong.",
      type: "warning",
      timer: 2000,
      showConfirmButton: false
    });
  }
  else {
    $.ajax({
      url: "ajax.php",
      type: "POST",
      data: {
        update_pinjam: true,
        id_peminjaman: id,
        id_komisi: komisi,
        no_hp: no_hp,
        tgl_peminjaman: tgl,
        keterangan: ket
      },
      success: function (result) {
        console.log(result);
        swal({
          title: "Sukses",
          text: "Data telah disimpan.",
          type: "success",
          timer: 2000,
          //confirmButtonText: '<a href="print_form.php?print_id='+result+'" target="_blank">Cetak form</a>'
          showConfirmButton: false
        }).then(function () {
          //window.location.href = 'print_form.php?print_id='+result; 
          location.href = "../";
          window.open('print_form.php','_blank');
        });
      }
    });
  }
});

// Modal Detail Pnjam
$('.modalDetail').click(function () {
  var id = $(this).attr('data-id');
  console.log(id);
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: {usulan_pinjam_cek: id},
    success: function (result) {
      console.log(result)
      var data = JSON.parse(result);
      $('#example4').dataTable().fnClearTable();
      table4.rows.add(data).draw();
    }
  });
});
// Modal Detail Pinjam
$('.modalPinjam').click(function () {
  var id = $(this).attr('data-id');
  console.log(id);
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: {usulan_pinjam: id},
    success: function (result) {
      console.log(result)
      var data = JSON.parse(result);
      $('#example5').dataTable().fnClearTable();
      table5.rows.add(data).draw();
    }
  });
});

// Modal Approve
$('.modalApprove').click(function () {
  var id = $(this).attr('data-id');
  console.log(id);
  $("#id_approve").val(id);
});
$('#btnApprove').click(function () {
  var id = $('#id_approve').val();
  console.log(id);
  $.ajax({
    url: "ajax.php",
    type: "GET",
    data: {approve: id},
    success: function (result) {
      console.log(result);
      swal({
        title: "Sukses",
        text: "Harap tunggu sejenak.",
        type: "success",
        timer: 2000,
        showConfirmButton: false
      }).then(function () {
        location.reload();
      });
    }
  });
});
// Modal Delete
$('.modalReject').click(function () {
  var id = $(this).attr('data-id');
  console.log(id);
  $("#id_reject").val(id);
});
$('#btnReject').click(function () {
  var id = $('#id_reject').val();
  console.log(id);
  $.ajax({
    url: "ajax.php",
    type: "GET",
    data: {reject: id},
    success: function (result) {
      console.log(result);
      swal({
        title: "Sukses",
        text: "Harap tunggu sejenak.",
        type: "success",
        timer: 2000,
        showConfirmButton: false
      }).then(function () {
        location.reload();
      });
    }
  });
});

// Modal Pengembalian
/* $('.modalGambar').click(function () {
  $("#gambar").attr("src","../dist/img/avatar2.png");
}); */
$('.modalKembali').click(function () {
  var id = $(this).attr('data-id');
  console.log(id);
  $("#id_pinjam").val(id);
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: {cek_pinjam: id},
    success: function (result) {
      console.log(result);
      var data = JSON.parse(result);
      $("#tgl_pengembalian").val(data.tgl_kembali);
      $('#tabel_catatan').dataTable().fnClearTable();
      catat_tabel.rows.add(data.items).draw();
    }
  });
});
$('#btnKembali').click(function () {
  var id = $('#id_pinjam').val();
  var ket = $('#keterangan_kembali').val();
  var tgl_realisasi = $('#realisasi_pengembalian').val();
  var detil_item = $('input[name="detil_item[]"]').map(function(){return $(this).val();}).get().join("|");
  var catat = $('input[name="catatan[]"]').map(function(){return $(this).val();}).get().join("|");
  //console.log(id);
  //alert(ket);
  if(ket == '' || tgl_realisasi == '') {
    swal({
      title: "Peringatan",
      text: "Data tidak boleh ada yang kosong.",
      type: "warning",
      timer: 2000,
      showConfirmButton: false
    });
  }
  else {
    $.ajax({
      url: "ajax.php",
      type: "POST",
      data: {kembali: id, realisasi_pengembalian: tgl_realisasi, item_detil: detil_item, catatan: catat, keterangan: ket},
      success: function (result) {
        console.log(result);
        swal({
          title: "Sukses",
          text: "Harap tunggu sejenak.",
          type: "success",
          timer: 2000,
          showConfirmButton: false
        }).then(function () {
          location.reload();
        });
      }
    });
  }
});

//SMS
$('.btnSms').click(function () {
  var id = $(this).attr('data-id');
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: {sms_reminder: true, id_peminjaman: id},
    success: function (result) {
      console.log(result);
      swal({
        title: "Sukses!",
        text: "Berhasil mengirim pesan.",
        type: "success",
        timer: 2000,
        showConfirmButton: false
      }).then(function () {
        //location.reload();
      });
    }
  });
});
// WA test
$('.btnWA').click(function () {
  var id = $(this).attr('data-id');
  var phonenumber = $(this).attr('data-number');
  //alert(phonenumber);
  if(navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPhone/i)){
      //code for iPad here
      window.location.href = "https://api.whatsapp.com/send?phone="+phonenumber+"";
  }
  else if(navigator.userAgent.match(/Android/i)){
      //code for Android here
      window.location.href = "intent://send/"+phonenumber+"#Intent;scheme=smsto;package=com.whatsapp;action=android.intent.action.SENDTO;end"
      //alert('this is an Android');
  }
  else {
      window.location.href = "https://api.whatsapp.com/send?phone="+phonenumber+"";
  }
  /* $.ajax({
    url: "ajax.php",
    type: "POST",
    data: {wa_reminder: true, id_peminjaman: id},
    success: function (result) {
      console.log(result);
      swal({
        title: "Sukses!",
        text: "Berhasil mengirim pesan.",
        type: "success",
        timer: 2000,
        showConfirmButton: false
      }).then(function () {
        //location.reload();
      });
    }
  }); */
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