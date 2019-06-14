function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
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

var ringkas = $('#ringkas').DataTable({
    'retrieve': true,
    'paging': false,
    'lengthChange': false,
    'searching': false,
    'ordering': true,
    'info': false,
    'autoWidth': true,
    'responsive': true
    //'pageLength': 5
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

$('#summary').hide();
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
    var jenis = $("input[name='radio_jenis']:checked").val();
    console.log(id);
    //alert(jenis);
    if(tgl_awal == '' || tgl_akhir == '' || jenis == '') {
        swal({
          title: "Peringatan",
          text: "Data tidak boleh ada yang kosong.",
          type: "warning",
          timer: 2000,
          showConfirmButton: false
        });
    }
      else {
        if(jenis == 'detil'){
            $.ajax({
                url: "ajax.php",
                type: "POST",
                data: {filter: id, tgl_awal: tgl_awal, tgl_akhir: tgl_akhir, jenis_laporan: jenis},
                success: function (result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    $('#example1').dataTable().fnClearTable();
                    tabel.rows.add(data).draw();
                    $('#detil').show();
                    $('#summary').hide();
                }
            });
        }
        else {
            $.ajax({
                url: "ajax.php",
                type: "POST",
                data: {filter: id, tgl_awal: tgl_awal, tgl_akhir: tgl_akhir, jenis_laporan: jenis},
                success: function (result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    $('#ringkas').dataTable().fnClearTable();
                    ringkas.rows.add(data).draw();
                }
            });
            $.ajax({
                url: "ajax-graph.php",
                type: "POST",
                data: {filter: id, tgl_awal: tgl_awal, tgl_akhir: tgl_akhir, jenis_laporan: jenis},
                success: function (result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    
                    var ruang = [];
                    var jumlahdata = [];
                    var warna = [];
                    //alert(data.grafik);
                    for(var i in data) {
                        ruang.push(data[i].aset);
                        jumlahdata.push(data[i].jumlah);
                        warna.push(getRandomColor());
                    }
                    var ctx = document.getElementById("myChartA");
                    var barGraph = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ruang,
                            datasets: [{
                                label: 'Jumlah Pemeliharaan',
                                data: jumlahdata,
                                backgroundColor: warna
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                }
            });
            $('#summary').show();
            $('#detil').hide();
        }
    }
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