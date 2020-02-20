$(document).ready(function(){
    var tabel_detil = $('#example4').DataTable({
        'retrieve': true,
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'responsive': true
    });
    var komisi, ruang, jumlahdata, jumlahdata1, warna1, warna, id_ruang, id_komisi;
    var ctx, ctx1;
    var barGraph, barGraph1;
    function getRandomColor() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    $.ajax({
        url: "graph-data.php",
        method: "POST",
        data: "ruangan",
        success: function(result) {
            console.log(result);
            var data = JSON.parse(result);
            ruang = [];
            jumlahdata1 = [];
            warna1 = [];
            id_ruang = [];

            for(var i in data) {
                ruang.push(data[i].ruangan);
                jumlahdata1.push(data[i].jumlah);
                id_ruang.push(data[i].id);
                warna1.push(getRandomColor());
            }
            ctx = document.getElementById("myChart").getContext("2d");
            barGraph = new Chart(ctx, {
                type: 'pie',
                data: {
                    id: id_ruang,
                    labels: ruang,
                    datasets: [{
                        label: 'Jumlah Aset',
                        data: jumlahdata1,
                        backgroundColor: warna1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    onClick: graphClickEvent
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
    $.ajax({
        url: "graph-data.php",
        method: "POST",
        data: "komisi",
        success: function(result) {
            console.log(result);
            var data = JSON.parse(result);
            komisi = [];
            id_komisi = [];
            jumlahdata = [];
            warna = [];

            for(var i in data) {
                komisi.push(data[i].komisi);
                jumlahdata.push(data[i].jumlah);
                id_komisi.push(data[i].id);
                warna.push(getRandomColor());
            }
            ctx1 = document.getElementById("myChartA").getContext("2d");
            barGraph1 = new Chart(ctx1, {
                type: 'pie',
                data: {
                    id: id_komisi,
                    labels: komisi,
                    datasets: [{
                        label: 'Jumlah Aset',
                        data: jumlahdata,
                        backgroundColor: warna
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    onClick: graphClickEvent_komisi
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
    function graphClickEvent(event, array){
    //function graphClickEvent(array){
        var activePoints = barGraph.getElementsAtEvent(event);
        if (activePoints[0]) {
            var chartData = activePoints[0]['_chart'].config.data;
            var idx = activePoints[0]['_index'];
            var nama = chartData.labels[idx];
            var label = chartData.id[idx];
            $('#modal_list').text('Daftar Aset pada '+nama);
            $.ajax({
                url: "graph-data.php",
                method: "POST",
                data: "item_ruangan="+label,
                success: function(result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    $('#example4').dataTable().fnClearTable();
                    tabel_detil.rows.add(data).draw();
                    $('#modal-list').modal('show');
                }
            });
            /* var value = chartData.datasets[0].data[idx];
            var url = "http://example.com/?label=" + label + "&value=" + value;
            console.log(url);
            alert(url); */
        }
    }
    function graphClickEvent_komisi(event, array){
    //function graphClickEvent(array){
        var activePoints = barGraph1.getElementsAtEvent(event);
        console.log(activePoints);
        if (activePoints[0]) {
            var chartData = activePoints[0]['_chart'].config.data;
            var idx = activePoints[0]['_index'];
    
            var nama = chartData.labels[idx];
            var label = chartData.id[idx];
            //alert(label);
            $('#modal_list').text('Daftar Aset pada '+nama);
            $.ajax({
                url: "graph-data.php",
                method: "POST",
                data: "item_komisi="+label,
                success: function(result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    $('#example4').dataTable().fnClearTable();
                    tabel_detil.rows.add(data).draw();
                    $('#modal-list').modal('show');
                }
            });
        }
    }
});