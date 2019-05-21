// Select2
$('.select2').select2();

// DataTable
var tabel = $('#example1').DataTable({
    'autoWidth': true,
    'responsive': true,
    "scrollX": true
});

$('#example2').DataTable({
    'paging': true,
    'lengthChange': false,
    'searching': false,
    'ordering': true,
    'info': true,
    'autoWidth': true,
    'responsive': true,
    'pageLength': 5,
    "scrollX": true
});

// datepicker
$('#multidate').datepicker({
    multidate: true,
    maxViewMode: 'days',
    //autoclose: true,
    format: 'dd'
});
$('#year-picker').datepicker( {
    multidate: true,
    startView: 'months',
    minViewMode: 'months',
    format: 'mm'
});
$('#datepicker').daterangepicker({
    singleDatePicker: true,
    autoclose: true,
    locale: {
        cancelLabel: 'Clear',
        format: 'DD/MM/YYYY'
    }
});
$('#datepicker1').daterangepicker({
    singleDatePicker: true,
    autoclose: true,
    locale: {
        cancelLabel: 'Clear',
        format: 'DD/MM/YYYY'
    }
});
$('#datepicker2').daterangepicker({
    singleDatePicker: true,
    autoclose: true,
    locale: {
        cancelLabel: 'Clear',
        format: 'DD/MM/YYYY'
    }
});

$('#reservation').daterangepicker({
    autoclose: true,
    locale: {
        cancelLabel: 'Clear',
        format: 'DD/MM/YYYY'
    }
});
$('#datepicker').val('');
$('#datepicker1').val('');
$('#reservation').val('');
$('#datepicker').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
});
$('#datepicker1').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
});
$('#reservation').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
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

// Modal Filter
$('.Filter').click(function () {
    var id = $(this).attr('data-id');
    console.log(id);
    $("#id_filter").val(id);
});
$('#btnFilter').click(function () {
    var id = $('#id_filter').val();
    var tgl_awal = $('#datepicker').val();
    var tgl_akhir = $('#datepicker1').val();
    console.log(id);
    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {filter: id, tgl_awal: tgl_awal, tgl_akhir: tgl_akhir},
        success: function (result) {
            console.log(result);
            var data = JSON.parse(result);
            $('#example1').dataTable().fnClearTable();
            tabel.rows.add(data).draw();
        }
    });
});

// Logout
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