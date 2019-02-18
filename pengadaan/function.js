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
        cache: false,
        type: "GET",
        data: "approve=" + id,
        success: function (result) {
            console.log(result)
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
        cache: false,
        type: "GET",
        data: "approve=" + id,
        success: function (result) {
            console.log(result)

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
                window.location.href = "logout.php";
                //return false;
            })
        }
    })
});