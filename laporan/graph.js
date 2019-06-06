$(document).ready(function(){
    /* $.ajax({
        url: "graph-data.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var player = [];
            var score = [];
            for(var i in data) {
                player.push("Bulan-" + data[i].bulan);
                score.push(data[i].jumlah);
            }
            var chartdata = {
                labels: player,
                datasets : [
                    {
                        label: 'Jumlah Aset per Ruangan',
                        backgroundColor: 'rgb(0, 174, 255)',
                        data: score
                    }
                ]
            };
            var ctx = $("#mycanvas");
            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                    title: {
                        display: true,
                        text: 'Jumlah Pendaftar per Bulan',
                        fontSize: 18
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    }); */
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
            var ruang = [];
            var jumlahdata = [];
            var warna = [];

            for(var i in data) {
                ruang.push(data[i].ruangan);
                jumlahdata.push(data[i].jumlah);
                warna.push(getRandomColor());
            }
            var ctx = document.getElementById("myChart");
            var barGraph = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ruang,
                    datasets: [{
                        label: 'Jumlah Aset',
                        data: jumlahdata,
                        backgroundColor: warna
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
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
            var komisi = [];
            var jumlahdata = [];
            var warna = [];

            for(var i in data) {
                komisi.push(data[i].komisi);
                jumlahdata.push(data[i].jumlah);
                warna.push(getRandomColor());
            }
            var ctx = document.getElementById("myChartA");
            var barGraph = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: komisi,
                    datasets: [{
                        label: 'Jumlah Aset',
                        data: jumlahdata,
                        backgroundColor: warna
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
});