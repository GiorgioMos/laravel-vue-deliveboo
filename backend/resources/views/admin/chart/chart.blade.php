@extends('layouts.admin')

@section('content')
    <div style="width: 80%; margin: auto;">
        <canvas id="barChart"></canvas>
        <div onclick="myChart.resetZoom();" class="btn btn-warning mt-5 px-3 py-1 fw-bold text-white">Reset zoom</div>
    </div>

    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($data['labels']),
                datasets: [{
                    label: 'Valore Ordini',
                    data: @json($data['data']),
                    backgroundColor: '#066e7c',
                    borderColor: 'black',
                    borderWidth: 1,
                    fill: false,
                    tension: 0.1

                }]
            },
            options: {
                scales: {
                    y: { // not 'yAxes: [{' anymore (not an array anymore)
                        ticks: {
                            color: "white", // not 'fontColor:' anymore
                            // fontSize: 18,
                            font: {
                                size: 18, // 'size' now within object 'font {}'
                            },
                            stepSize: 1,
                            beginAtZero: true
                        }
                    },
                    x: { // not 'xAxes: [{' anymore (not an array anymore)
                        ticks: {
                            color: "white", // not 'fontColor:' anymore
                            //fontSize: 14,
                            font: {
                                size: 18 // 'size' now within object 'font {}'
                            },
                            stepSize: 1,
                            beginAtZero: true
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: "white", // not 'fontColor:' anymore
                            // fontSize: 18  // not 'fontSize:' anymore
                            font: {
                                size: 18 // 'size' now within object 'font {}'
                            }
                        }
                    },
                    zoom: {
                        zoom: {
                            wheel: {
                                enabled: true,
                            },
                            pinch: {
                                enabled: true
                            },
                            mode: 'x',
                        }
                    }
                }
            }
        });
    </script>
@endsection
