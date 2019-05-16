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
    $.ajax({
        url: "graph-data.php",
        method: "POST",
        data: "ruangan",
        success: function(result) {
            console.log(result);
            var data = JSON.parse(result);
            var ruang = [];
            var jumlahdata = [];

            for(var i in data) {
                ruang.push(data[i].ruangan);
                jumlahdata.push(data[i].jumlah);
            }
            var ctx = document.getElementById("myChart");
            var barGraph = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ruang,
                    datasets: [{
                        label: 'Jumlah Aset',
                        data: jumlahdata,
                        backgroundColor: [
                            'rgb(202, 17, 17)',
                            'rgb(223, 125, 14)',
                            'rgb(22, 125, 14)',
                            'rgb(23, 15, 14)',
                            'rgb(223, 12, 114)'
                        ]
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

            for(var i in data) {
                komisi.push(data[i].komisi);
                jumlahdata.push(data[i].jumlah);
            }
            var ctx = document.getElementById("myChartA");
            var barGraph = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: komisi,
                    datasets: [{
                        label: 'Jumlah Aset',
                        data: jumlahdata,
                        backgroundColor: [
                            'rgb(202, 17, 17)',
                            'rgb(223, 125, 14)',
                            'rgb(22, 125, 14)',
                            'rgb(23, 15, 14)',
                            'rgb(223, 12, 114)'
                        ]
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