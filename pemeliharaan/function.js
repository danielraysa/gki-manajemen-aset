// Select2
$('.select2').select2();

// DataTable
$('#example1').DataTable({
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
$('#reservation').val('');
$('#datepicker').on('cancel.daterangepicker', function(ev, picker) {
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

$('#opsi_berkala').select2({
    minimumResultsForSearch: -1
});
$('#satuan').select2({
    minimumResultsForSearch: -1
});

$('#custom-box').hide();
$('.opsi_bulan').hide();
$('.opsi_tahun').hide();
$('#opsi_berkala').on('change', function(){
    //alert($('#opsi_berkala').val());
    var opt = $('#opsi_berkala').val();
    if (opt == "custom") {
        $('#custom-box').show();
    }
    else {
        $('#custom-box').hide();
    }
});
$('#satuan').on('change', function(){
    var sat = $('#satuan').val();
    if (sat == "Bulan") {
        $('.opsi_bulan').show();
        $('.opsi_tahun').hide();
    }
    else if (sat == "Tahun"){
        $('.opsi_tahun').show();
        $('.opsi_bulan').hide();
    }
    else {
        $('.opsi_bulan').hide();
        $('.opsi_tahun').hide();
    }
});

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

/* $('#modal-jadwal').on('hide.bs.modal', function () {
    $('#opsi_berkala').val('sekali');
    $("#opsi_berkala").select2("destroy").select2({minimumResultsForSearch: -1});
    $('#satuan').val('Minggu');
    $("#satuan").select2("destroy").select2({minimumResultsForSearch: -1});
    $('#custom-box').hide();
}); */
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
            console.log(result+"\n");
            var data = JSON.parse(result);
            //$('#id_aset').val(data.id_aset);
            $('#kode_aset').val(data.kode_aset);
            $('#nama_aset').val(data.nama_aset);
        }
    });
});
$('#addJadwal').click(function () {
    var id = $('#id_aset').val();
    var tgl = $('#datepicker').val();
    var opsi = $('#opsi_berkala').val();
    var notif = $('#notif').val();
    //var opsi_pilihan = $('#multidate').val();
    //var pilihan_bln = $('#year-picker').val();
    var frekuensi = $('#satuan').val();
    var interv = $('#interval').val();
    if(satuan == "Bulan") {
        var opsi_pilihan = $('#multidate').val();
    }
    else if(satuan == "Tahun") {
        var opsi_pilihan = $('#year-picker').val();
    }
    else {
        var opsi_pilihan = "minggu";
    }
    location.reload();
    //alert(pilihan_tgl);
    if(opsi!="custom"){
        $.ajax({
            url: "ajax.php",
            type: "POST",
            //data: {jadwal_periodik: true, id_aset: id, masa_pemeliharaan: periode, jumlah: jml},
            data: {add_jadwal: true, id_aset: id, tgl_pemeliharaan: tgl, notifikasi: notif, pilihan: opsi},
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
    else {
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: {jadwal_custom: true, id_aset: id, tgl_pemeliharaan: tgl, notifikasi: notif, interval: interv, satuan: frekuensi, pilihan_tgl: opsi_pilihan},
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

// Modal Maintenance
$('.modalMaintenance').click(function () {
    var id = $(this).attr('data-id');
    //var ids = $(this).attr('data-ids');
    console.log(id);
    $("#id_maintenance").val(id);
    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {id_maint: id},
        success: function (result) {
            console.log(result);
            var data = JSON.parse(result);
            $('#kode_aset_s').val(data.kode_aset);
            $('#nama_aset_s').val(data.nama_aset);
            $('#datepicker_read').val(data.tgl_jadwal);
        }
    });
});
$('#btnMaintenance').click(function () {
    var id = $('#id_maintenance').val();
    var hrg = $('#harga').val();
    var tgl_pelihara = $('#datepicker1').val();
    var tgl_selesai = $('#datepicker2').val();
    var ket = $('#keterangan').val();
    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {id_maintenance: id, biaya: hrg, tgl_pemeliharaan: tgl_pelihara, tgl_selesai: tgl_selesai, keterangan: ket},
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