$(document).ready(function() {
    // Select2
    $('.select2').select2();

    // DataTable
    $('#example1').DataTable({
        'autoWidth': true,
        'responsive': true,
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

    /* $("#barang").on('change', function() {
        $("#nama_barang").val($("#barang").find(":selected").text());
        //console.log($(this).val());
        //alert($("#nama_barang").val());
    }); */
    $("#currency").on('keyup', function() {
        $("#rupiah").val($('#currency').val());
        //console.log($("#rupiah").val());
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
    /* $('.modalDelete').click(function () {
        var id = $(this).attr('data-id');
        console.log(id);
        $("#id_delete").val(id);
    }); */
    $('.modalDelete').click(function () {
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

    var kode1 = "";
    var kode2 = "";
    var kode3 = "";
    var kode4 = "";
    var kode5 = "";
    $('#kode_aset').val(kode1+kode2+kode3+kode4+kode5);

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
                kode4 = $('#barang_aset').find(':selected').data('item');
                $('#harga').val(data.harga);
                $('#kode_aset').val(kode1+""+kode2+""+kode3+""+kode4+""+kode5);
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
    $('#penyusutan').on('ifChecked', function(event){
        $('#currency').prop("disabled", false);
        $('#manfaat_aset').prop("disabled", false);
    });
    $('#penyusutan').on('ifUnchecked', function(event){
        $('#currency').prop("disabled", true);
        $('#manfaat_aset').prop("disabled", true);
    });
    $('#datepicker').on('change', function(){
        var tgl = $('#datepicker').val();
        kode3 = tgl.substr(8,2);
        //alert(kode3);
        $('#kode_aset').val(kode1+""+kode2+""+kode3+""+kode4+""+kode5);
    });
    $('#barang_aset').on('change', function(){
        kode4 = $(this).find(':selected').data('item');
        //alert(kode4);
        $('#kode_aset').val(kode1+""+kode2+""+kode3+""+kode4+""+kode5);
    });
    $('#ruangan_aset').on('change', function(){
        kode2 = $(this).find(':selected').data('ruang');
        //alert(kode2);
        $('#kode_aset').val(kode1+""+kode2+""+kode3+""+kode4+""+kode5);
    });
    $('#komisi_aset').on('change', function(){
        kode1 = $(this).find(':selected').data('komisi');
        //alert(kode1);
        $('#kode_aset').val(kode1+""+kode2+""+kode3+""+kode4+""+kode5);
    });
    $('#nomor_aset').on('change', function(){
        kode5 = $(this).val();
        //alert(kode1);
        $('#kode_aset').val(kode1+""+kode2+""+kode3+""+kode4+""+kode5);
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