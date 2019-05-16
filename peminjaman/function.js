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

$('#tgl_pengembalian').datepicker({
  format: 'dd/mm/yyyy',
  autoclose: true
});

$('#realisasi_pengembalian').datepicker({
  format: 'dd/mm/yyyy',
  autoclose: true
});

/* $("#example1").on('click', '#remove', function (e) {
  $(this).parent().parent().remove();
  //console.log(e);
}); */

$('.emptyData').on('click', function () {
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: "empty",
    success: function (result) {
      //console.log(id);
      location.reload();
    }
  });
});

//Tambah Pinjam
$('.addPinjam').on('click', function () {
  var id = $(this).attr('data-id');
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: "add-pinjam=" + id,
    success: function (result) {
      //console.log(result);
      location.reload();
    }
  });
});

//Hapus Item
$('#remove').on('click', function () {
  var id = $(this).attr('data-id');
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: "hapus_item=" + id,
    success: function (result) {
      //console.log(result);
      location.reload();
    }
  });
});
// Simpan Pinjam
$('#btnSimpan').click(function () {
  //var peminjam = $('#peminjam_aset').val();
  var komisi = $('#komisi_peminjam').val();
  var no_hp = $('#nohp').val();
  var tgl = $('#reservation').val();
  var ket = $('#keterangan').val();
  //alert(peminjam+" / "+komisi+" / "+no_hp);
  //alert(komisi+" / "+no_hp);
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: {
      simpan_pinjam: true,
      //id_peminjam: peminjam,
      id_komisi: komisi,
      no_hp: no_hp,
      tgl_peminjaman: tgl,
      keterangan: ket
    },
    success: function (result) {
      console.log(result);
      swal({
        title: "Success!",
        text: "Closing in 2 seconds.",
        type: "success",
        timer: 2000,
        showConfirmButton: false
      }).then(function () {
        location.reload();
      });
    }
  });
});

// Modal Detail Pnjam
$('.modalDetail').click(function () {
  var id = $(this).attr('data-id');
  console.log(id);
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: "usulan_pinjam=" + id,
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
    data: "usulan_pinjam=" + id,
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
    data: "approve=" + id,
    success: function (result) {
      console.log(result);
      swal({
        title: "Success!",
        text: "Closing in 2 seconds.",
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
    data: "reject=" + id,
    success: function (result) {
      console.log(result);
      swal({
        title: "Success!",
        text: "Closing in 2 seconds.",
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
$('.modalGambar').click(function () {
  $("#gambar").attr("src","../dist/img/avatar2.png");
});
$('.modalKembali').click(function () {
  var id = $(this).attr('data-id');
  console.log(id);
  $("#id_pinjam").val(id);
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: "cek_pinjam=" + id,
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
  var ket = $('#keterangan').val();
  var tgl_realisasi = $('#realisasi_pengembalian').val();
  var detil_item = $('input[name="detil_item[]"]').map(function(){return $(this).val();}).get().join("|");
  var catat = $('input[name="catatan[]"]').map(function(){return $(this).val();}).get().join("|");
  console.log(id);
  //alert(catat);
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: {kembali: id, realisasi_pengembalian: tgl_realisasi, item_detil: detil_item, catatan: catat, keterangan: ket},
    success: function (result) {
      console.log(result);
      swal({
        title: "Success!",
        text: "Closing in 2 seconds.",
        type: "success",
        timer: 2000,
        showConfirmButton: false
      }).then(function () {
        location.reload();
      });
    }
  });
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
        title: "Success!",
        text: "Berhasil mengirim pesan.",
        type: "success",
        timer: 2000,
        showConfirmButton: false
      }).then(function () {
        location.reload();
      });
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
    confirmButtonText: 'Yes'
  }).then((result) => {
    if (result.value) {
      swal({
        title: "Success!",
        text: "Redirecting in 2 seconds.",
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