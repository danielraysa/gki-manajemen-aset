// Select2
$('.select2').select2();

// DataTable
$('#example1').DataTable({
    'autoWidth': true,
    'responsive': true
});
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

// datepicker
$('#datepicker').datepicker({
    format: 'dd/mm/yyyy',
    autoclose: true
});
$('#reservation').daterangepicker({
    autoclose: true,
    locale: {
        format: 'DD/MM/YYYY'
    }
});
/* $('#reservation').daterangepicker({
    locale: {
        format: 'YYYY-MM-DD'
    }
}); */

// Inputmask
$('#currency').inputmask("numeric", {
    radixPoint: ",",
    groupSeparator: ".",
    digits: 2,
    autoGroup: true,
    prefix: " Rp. ",
    rightAlign: false,
    removeMaskOnSubmit: true,
    onCleared: function () {
        self.Value('');
    }
});
$('#harga').inputmask("numeric", {
    radixPoint: ",",
    groupSeparator: ".",
    digits: 2,
    autoGroup: true,
    prefix: " Rp. ",
    rightAlign: false,
    removeMaskOnSubmit: true,
    onCleared: function () {
        self.Value('');
    }
});
$('#txt_harga').inputmask("numeric", {
    radixPoint: ",",
    groupSeparator: ".",
    digits: 2,
    autoGroup: true,
    prefix: "Rp. ",
    rightAlign: false
});

// Modal Jadwal
$('.modalJadwal').click(function () {
    var id = $(this).attr('data-id');
    console.log(id);
    $("#id_aset").val(id);
    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {id_aset: id},
        success: function (result) {
            console.log(result);
            var data = JSON.parse(result);
            //$('#id_aset').val(data.id_aset);
            $('#kode_aset').val(data.kode_aset);
            $('#nama_aset').val(data.nama_aset);
        }
    });
});
$('#addJadwal').click(function () {
    var id = $('#id_aset').val();
    var tgl = $('#reservation').val();
    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {add_jadwal: true, id_aset: id, tgl_pemeliharaan: tgl},
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

// Modal Maintenance
$('.modalMaintenance').click(function () {
    var id = $(this).attr('data-id');
    var ids = $(this).attr('data-ids');
    console.log(id);
    $("#id_maintenance").val(id);
    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {id_aset: ids},
        success: function (result) {
            console.log(result);
            var data = JSON.parse(result);
            $('#kode_aset_s').val(data.kode_aset);
            $('#nama_aset_s').val(data.nama_aset);
        }
    });
});
$('#btnMaintenance').click(function () {
    var id = $('#id_maintenance').val();
    var hrg = $('#harga').val();
    var tgl = $('#datepicker').val();
    var ket = $('#keterangan').val();
    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {id_maintenance: id, biaya: hrg, tgl_pemeliharaan: tgl, keterangan: ket},
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
$('.modalDelete').click(function () {
    var id = $(this).attr('data-id');
    console.log(id);
    $("#id_delete").val(id);
});
$('#btnDelete').click(function () {
    var id = $('#id_delete').val();
    console.log(id);
    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: "id_cancel=" + id,
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


// Logout
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