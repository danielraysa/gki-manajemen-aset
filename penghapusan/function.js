$(document).ready(function() {
    // Select2
    $('.select2').select2();

    // DataTable
    $('#example1').DataTable({
        'autoWidth': true,
        'responsive': true
    });
    $('#tabeldata').DataTable({
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
        format: 'yyyy-mm-dd',
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

    /* $("#barang").on('change', function() {
        $("#nama_barang").val($("#barang").find(":selected").text());
        //console.log($(this).val());
        //alert($("#nama_barang").val());
    }); */
    $("#currency").on('keyup', function() {
        $("#rupiah").val($('#currency').val());
        //console.log($("#rupiah").val());
    });
    // Add Button
    /*
    $('#addBtn').click(function () {
        var nama = $('#nama').val();
        var brg = $('#barang').val();
        var nm_brg = $('#barang').find("option:selected").text();
        //var jml = $('#jumlah').val();
        var hrg = $('#currency').val();
        var hrg1 = $('#currency').inputmask("remove").val();
        //var ket = $('#keterangan').val();
        //alert(nm_brg);
        console.log(nama, brg, hrg1);
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: {add: true, nama: nama, barang: brg, nama_barang: nm_brg, harga: hrg},
            success: function (result) {
                console.log(result)
                var data = JSON.parse(result);
                $('#example2').dataTable().fnDestroy();
                $('#example2').DataTable({
                    "data": data,
                    "columns": [
                    
                    { "title": "Nama Aset" },
                    { "title": "Jenis Barang" },
                    
                    { "title": "Harga", "class": "center" },
                    { "title": "Action", "class": "center" }
                    ]
                });
            }
        });
    });
    */

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
            data: "delete-usulan=" + id,
            success: function (result) {
                console.log(result);
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
    // Modal Aset
    $('.modalAset').click(function () {
        var id = $(this).attr('data-id');
        console.log(id);
        $.ajax({
            url: "ajax.php",
            cache: false,
            type: "GET",
            data: "ID=" + id,
            success: function (result) {
                console.log(result)
                var data = JSON.parse(result);
                $('#id_edit').val(data.id);
                $('#nama').val(data.nama);
                $('#barang').val(data.barang);
                $('#jumlah').val(data.jumlah);
                $('#harga').val(data.harga);
                $('#keterangan').val(data.keterangan);
            }
        });
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

    $('.insert-item').click(function () {
        //var id = $(this).attr('data-id');
        var id = $(this).val();
        console.log(id);
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: "id-insert=" + id,
            success: function (result) {
                console.log(result)
                var data = JSON.parse(result);
                $('#id_aset').val(data.id);
                $('#nama_aset').val(data.nama);
                $('#barang_aset').val(data.barang);
                $("#barang_aset").select2("destroy").select2();
                $('#harga').val(data.harga);
            }
        });
    });

    $('#check_jml').on('ifChecked', function(event){
        //alert(event.type + ' callback');
        $('#jumlah_aset').prop("disabled", false);
        
    });
    $('#check_jml').on('ifUnchecked', function(event){
        $('#jumlah_aset').prop("disabled", true);
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
});