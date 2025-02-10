@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <style>
        /* Override container styles */
    .container-fluid {
        padding-right: 0 !important;
        padding-left: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
        width: 100vw !important;
    }

    /* Ensure row takes full width */
    .row {
        margin-right: 0 !important;
        margin-left: 0 !important;
        width: 100% !important;
    }

    /* Override any padding from app.blade.php */
    main.main-content {
        padding-right: 0 !important;
        padding-left: 0 !important;
        width: 100% !important;
    }

    /* Existing styles... */
    .container {
        margin: 0px;
        padding: 0px;
        width: 100%;
    }

        body, html, .container-fluid {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            margin: 0px;
            padding: 0px;
            background: #f4f6f9;
            width: 100%;
            max-width: 100%;
        }

        .row {
            width: 100%;
            margin-left: 0;
            margin-right: 0;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            width: 100%; /* Pastikan card memenuhi lebar kolom */
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card-header {
            font-weight: bold;
            background: #007bff;
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .download-btn {
            background: #28a745;
            color: white;
            border-radius: 20px;
            padding: 5px 15px;
        }

        .download-btn:hover {
            background: #218838;
        }

        canvas {
            max-width: 100%;
            height: auto;
        }
        
    </style>

    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card p-3">
                    <form method="GET" action="{{ route('dashboard') }}">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="month" class="form-label">Bulan</label>
                                <select id="month" name="month" class="form-control">
                                    <option value="">Semua</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $selectedMonth == $i ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $i, 10)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="year" class="form-label">Tahun</label>
                                <select id="year" name="year" class="form-control">
                                    <option value="">Semua</option>
                                    @for ($i = date('Y'); $i >= 2000; $i--)
                                        <option value="{{ $i }}" {{ $selectedYear == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="jenis_industri" class="form-label">Jenis Industri</label>
                                <select id="jenis_industri" name="jenis_industri" class="form-control">
                                    <option value="">Semua</option>
                                    @foreach ($jenisIndustriList as $industri)
                                        <option value="{{ $industri }}" {{ $selectedJenisIndustri == $industri ? 'selected' : '' }}>
                                            {{ $industri }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter"></i> Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-chart-bar"></i> Distribusi Status</span>
                        <button class="btn btn-sm download-btn" onclick="downloadChart('statusChart', 'Status_Distribution')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-chart-pie"></i> Detail Distribusi Izin</span>
                        <button class="btn btn-sm download-btn" onclick="downloadChart('detailIzinChart', 'Detail_Izin_Distribution')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <canvas id="detailIzinChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const statusData = @json($statusData);
        const detailIzinData = @json($detailIzinData);

        function downloadChart(canvasId, filename) {
            const canvas = document.getElementById(canvasId);
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = filename + '.png';
            link.click();
        }

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
                maintainAspectRatio: false, // Tambahkan ini untuk memastikan chart memenuhi lebar
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

        new Chart(document.getElementById('detailIzinChart'), {
            type: 'pie',
            data: {
                labels: detailIzinData.map(item => item.detail_izin),
                datasets: [{
                    data: detailIzinData.map(item => item.total),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Tambahkan ini untuk memastikan chart memenuhi lebar
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endsection