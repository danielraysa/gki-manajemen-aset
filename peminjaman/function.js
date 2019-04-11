$('#example1').DataTable();
$('#example2').DataTable({
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

$("#example1").on('click', '#remove', function (e) {
  $(this).parent().parent().remove();
  //console.log(e);
});

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
    data: "add-pinjam="+id,
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
    data: "hapus_item="+id,
    success: function (result) {
      //console.log(result);
      location.reload();
    }  
  });
});
// Simpan Pinjam
$('#btnSimpan').click(function () {
  var peminjam = $('#peminjam_aset').val();
  var komisi = $('#komisi_peminjam').val();
  var no_hp = $('#nohp').val();
  var tgl = $('#reservation').val();
  var ket = $('#keterangan').val();
  //alert(peminjam+" / "+komisi+" / "+no_hp);
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: {simpan_pinjam: true, id_peminjam: peminjam, id_komisi: komisi, no_hp: no_hp, tgl_peminjaman: tgl, keterangan: ket},
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



$('.logout').on('click', function (event) {
  event.preventDefault();
  swal({
    title: 'Do you want to log out?',
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