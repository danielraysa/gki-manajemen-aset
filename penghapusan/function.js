$(document).ready(function() {
    // Select2
    $('.select2').select2();

    // DataTable
    $('#example1').DataTable({
        'autoWidth': true,
        'responsive': true,
        'lengthChange': false,
        'searching': false,
        'pageLength': 5,
        "scrollX": true
    });
    $('#tabeldata').DataTable({
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

    // datepicker
    $('#datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
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

    $("#currency").on('keyup', function() {
        $("#rupiah").val($('#currency').val());
        //console.log($("#rupiah").val());
    });

    $('#status_aset').select2({
        minimumResultsForSearch: -1
    });

    // Modal Edit
    $('.modalLink').click(function () {
        var id = $(this).attr('data-id');
        console.log(id);
        $.ajax({
            url: "ajax.php",
            type: "GET",
            data: "ID=" + id,
            success: function (result) {
                console.log(result)
                var data = JSON.parse(result);
                $('#id_edit').val(data.id);
                $('#nama').val(data.nama);
                $('#barang').val(data.barang);
                //$('#jumlah').val(data.jumlah);
                $('#harga').val(data.harga);
                $('#keterangan').val(data.keterangan);
            }
        });
    });

    // Modal Delete
    $('#example1').on('click', '.modalDelete', function () {
        var id = $(this).attr('data-id');
        //var id = $('#id_delete').val();
        console.log(id);
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: "usulan-hapus=" + id,
            success: function (result) {
                console.log(result);
                location.reload();
            }
        });
    });
    $('.hapus-item').click(function () {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: "hapus-item="+id,
            success: function() {
                //console.log(result);
                location.reload();
            }
        });
    });
    $('#empty-all').click(function () {
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: "empty=true",
            success: function() {
                //console.log(result);
                location.reload();
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
            data: "reject=" + id,
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
    // Modal Aset
    $('#btnHapus').click(function () {
        var id = $('#id_hapus').val();
        var aset = $('input[name="aset[]"]').map(function(){return $(this).val();}).get().join("|");
        var sts = $('input[name="status[]"]').map(function(){return $(this).val();}).get().join("|");
        alert(sts);
        alert(aset);
        console.log(id);
        /* $.ajax({
            url: "ajax.php",
            type: "POST",
            data: {penghapusan: id, item_aset: aset, status: sts},
            success: function (result) {
                console.log(result);
                swal({
                    title: "Sukses",
                    text: "Harap tunggu sejenak.",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                }).then(function () {
                    window.location.assign("../penghapusan/")
                });
            }
        }); */
    });

    // Modal Detail Usulan
    $('.modalDetail').click(function () {
        var id = $(this).attr('data-id');
        console.log(id);
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: "usulan_detail=" + id,
            success: function (result) {
                console.log(result)
                var data = JSON.parse(result);
                $('#example4').dataTable().fnClearTable();
                //$('#example4').dataTable().fnDestroy();
                table4.rows.add(data).draw();
                /* $('#example4').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'info': true,
                    'autoWidth': true,
                    'responsive': true,
                    'pageLength': 5,
                    'data': data,
                    'columns': [
                        { "data": "engine" },
                        { "data": "browser" },
                        { "data": "platform" },
                        { "data": "grade" }
                    ]
                }); */
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
});