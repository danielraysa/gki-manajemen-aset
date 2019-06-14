$(document).ready(function() {
    function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
      
          reader.onload = function (e) {
                  $uploadedImg[0].style.backgroundImage='url('+e.target.result+')';
          };
      
          reader.readAsDataURL(input.files[0]);
        }
    }
    
    var $form = $("#imageUploadForm"), 
        $file = $("#file"), 
        $uploadedImg = $("#uploadedImg"), 
        $helpText = $("#helpText")
    ;
    $file.on('change', function(){
        readURL(this);
        $form.addClass('loading');
    });
    $uploadedImg.on('webkitAnimationEnd MSAnimationEnd oAnimationEnd animationend', function(){
        $form.addClass('loaded');
    });
    $helpText.on('webkitAnimationEnd MSAnimationEnd oAnimationEnd animationend', function(){
        setTimeout(function() {
            $file.val('');  $form.removeClass('loading').removeClass('loaded');
        }, 5000);
    });
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

    $('#barangbaru').on('ifChecked', function(event){
        //$('#nama').show();
        $('#nama').prop("disabled", false);
        $('#barangusulan').prop("disabled", true);
    });
    $('#barangbaru').on('ifUnchecked', function(event){
        $('#nama').prop("disabled", true);
        //$('#nama').hide();
        $('#barangusulan').prop("disabled", false);
    });
    $('#barangusulan').on('change', function(){
        var nomor = $('#barangusulan').find(':selected').data('items');
        console.log(nomor);
        $('#barang').val(nomor);
        $("#barang").select2("destroy").select2();
    });

    //Add Barang
    $('#addBarang').click(function () {
        var modal_nama_barang = $('#modal_nama_barang').val();
        var modal_kategori = $('#modal_kategori').val();
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: {add_barang: true, nama: modal_nama_barang, kategori: modal_kategori},
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
    //Add Merk
    $('#addMerk').click(function () {
        var modal_nama_merk = $('#modal_merk').val();
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: {add_merk: true, nama_merk: modal_nama_merk},
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
    //Add Ruangan
    $('#addRuangan').click(function () {
        var modal_nama_ruangan = $('#modal_nama_ruangan').val();
        var modal_kode_ruangan = $('#modal_kode_ruangan').val();
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: {add_ruangan: true, nama_ruangan: modal_nama_ruangan, kode_ruangan: modal_kode_ruangan},
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
    //Add Komisi
    $('#addKomisi').click(function () {
        var modal_nama_komisi = $('#modal_nama_komisi').val();
        var modal_kode_komisi = $('#modal_kode_komisi').val();
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: {add_komisi: true, nama_komisi: modal_nama_komisi, kode_komisi: modal_kode_komisi},
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

    $('#form_add').submit(function() {
        var nomorasli = $('#barangusulan').find(':selected').data('items');
        $('#barang_backup').val(nomorasli);
        var cek = $('#barangusulan').prop('disabled');
        var cek1 = $('#nama').prop('disabled');
        if(cek) {
            var nama = $('#nama').val();
        }
        if(cek1){
            var nama = $('#barangusulan').val();
        }
        var barang = $('#barang').val();
        var harga = $('#currency').val();
        /* if(nomorasli != barang) {
            alert('beda');
        }
        else {
            alert('sama');
        }
        alert(nama+" / "+barang+" / "+harga+" / jenis : "+nomorasli); */
        if(nama == '' || barang == '' || harga == ''){
            swal({
                title: "Peringatan",
                text: "Data tidak boleh ada yang kosong.",
                type: "warning",
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }
        else {
            //alert(nama+" / "+barang+" / "+harga);
            return true;
        }
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
        $('#nomor_aset').val('');
        $('#nomor_aset').prop("readonly", true);
    });
    $('#check_jml').on('ifUnchecked', function(event){
        $('#jumlah_aset').prop("disabled", true);
        $('#nomor_aset').prop("readonly", false);
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
    
    /* $(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

    $('.btn-file :file').on('fileselect', function(event, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
    }); */
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
        //alert(label)
        readURL(this);
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
});