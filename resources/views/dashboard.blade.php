@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Override container padding and margin */
        .container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            width: 100% !important;
            max-width: none !important;
        }
        
        /* Override row margin */
        .row {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
        
        /* Adjust card spacing */
        .card {
            margin: 10px;
        }

        /* Override default content padding if exists */
        #app > main {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <!-- Card 1: Status Chart -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Status Distribution
                    </div>
                    <div class="card-body">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Card 2: Detail Izin Chart -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Detail Izin Distribution
                    </div>
                    <div class="card-body">
                        <canvas id="detailIzinChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Data dari controller
        const statusData = @json($statusData);
        const detailIzinData = @json($detailIzinData);

        // Status Chart (Bar Chart)
        new Chart(document.getElementById('statusChart'), {
            type: 'bar',
            data: {
                labels: statusData.map(item => item.status),
                datasets: [{
                    label: 'Jumlah',
                    data: statusData.map(item => item.total),
                    backgroundColor: '#FF6384'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Detail Izin Chart (Bar Chart)
        new Chart(document.getElementById('detailIzinChart'), {
            type: 'bar',
            data: {
                labels: detailIzinData.map(item => item.detail_izin),
                datasets: [{
                    label: 'Jumlah',
                    data: detailIzinData.map(item => item.total),
                    backgroundColor: '#36A2EB'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
