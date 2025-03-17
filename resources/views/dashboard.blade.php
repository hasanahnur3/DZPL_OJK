@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <style>
        .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #ffc107;
            color: black;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #e0a800;
        }

        /* Override container styles */
        .container-fluid {
            padding-right: 0 !important;
            padding-left: 0 !important;
            margin-right: 20 !important;
            margin-left: 10 !important;
            width: auto !important;
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
            height: auto;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            margin: 10px;
            padding: 10px;
            background: #f4f6f9;
            width: 100%;
            height: auto;
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
            width: 100%;
            height: auto; /* Ensure card fills column width */
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

        .main-content {
            background-color: white;
        }

        /* Ensure dropdown menus are clickable */
        .sidebar .dropdown-content .sub-item a,
        .sidebar .dropdown-menu a {
            pointer-events: auto !important;
            position: relative;
            z-index: 1100;
        }

        /* Fix for charts or other elements overlapping the sidebar */
        .main-content {
            position: relative;
            z-index: 900;
        }
    </style>

    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card p-3">
                    <form method="GET" action="{{ route('dashboard') }}">
                        <div class="row g-3">
                            <!-- Date Range Filter -->
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $startDate ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end_date" class="form-label">Tanggal Akhir</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $endDate ?? '' }}">
                            </div>
                            <div class="col-md-4">
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
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <button type="submit" style="background-color: #007bff; color: white;" class="btn w-100 mt-4"><i class="fas fa-filter"></i> Filter</button>
                            </div>
                            <div class="col-md-4 d-flex align-items-end justify-content-end">
                                <button type="button" class="btn w-100 mt-4" onclick="resetFilters()" style="color:white;"><i class="fas fa-undo"></i> Reset Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row" style="margin-bottom: 1cm">
            <h3>Kelembagaan</h3>
            <div class="col-md-6">
                <div class="card" style="height: 10.1cm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-chart-bar"></i> Distribusi Status Kelembagaan</span>
                        <button class="btn btn-sm download-btn" onclick="downloadChart('statusChart', 'Status_Distribution')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4" style="margin-bottom: 1cm">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-chart-pie"></i> Detail Distribusi Izin Kelembagaan</span>
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

   

    <div class="container-fluid">
        <div class="row" style="margin-bottom: 1cm">
            <h3>Kepengurusan</h3>
            <div class="col-md-6" style="margin-bottom: 1cm">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-chart-bar"></i> Distribusi Status Penilaian Kepengurusan PKK</span>
                        <button class="btn btn-sm download-btn" onclick="downloadChart('statusPenilaianChart', 'Status_Penilaian_Distribution')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <canvas id="statusPenilaianChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4" style="margin-bottom: 1cm">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-chart-bar"></i> Distribusi Hasil Penilaian</span>
                        <button class="btn btn-sm download-btn" onclick="downloadChart('hasilChart', 'Hasil_Penilaian_Distribution')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <canvas id="hasilChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6" style="margin-bottom: 1cm">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-chart-bar"></i> Distribusi Status Penilaian Kepengurusan TKA</span>
                        <button class="btn btn-sm download-btn" onclick="downloadChart('statusPerizinanChart', 'Status_Perizinan_Distribution')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <canvas id="statusPerizinanChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4" style="margin-bottom: 1cm">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-chart-bar"></i> Distribusi Hasil Penilaian</span>
                        <button class="btn btn-sm download-btn" onclick="downloadChart('jenisOutputChart', 'Hasil_Penilaian_Distribution')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <canvas id="jenisOutputChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6" style="margin-bottom: 1cm">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-chart-bar"></i> Distribusi Status Penilaian Kepengurusan Dirkom</span>
                        <button class="btn btn-sm download-btn" onclick="downloadChart('statusPerizinanDirkomChart', 'Status_Perizinan_Distribution')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <canvas id="statusPerizinanDirkomChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4" style="margin-bottom: 1cm">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-chart-bar"></i> Distribusi Hasil Penilaian</span>
                        <button class="btn btn-sm download-btn" onclick="downloadChart('jenisOutputDirkomChart', 'Hasil_Penilaian_Distribution')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <canvas id="jenisOutputDirkomChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div class="row" style="margin-bottom: 1cm">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-user-check"></i> Frekuensi Penguji</span>
                        <button class="btn btn-sm download-btn" onclick="downloadChart('frekuensiPengujiChart')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <canvas id="frekuensiPengujiChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-calendar-alt"></i> Jadwal Agenda</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Sumber</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allAgendas as $index => $agenda)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($agenda->date)->format('d F Y') }}</td>
                                        <td>{{ $agenda->source }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add this with your existing scripts
        function resetFilters() {
            document.getElementById('start_date').value = '';
            document.getElementById('end_date').value = '';
            document.getElementById('month').value = '';
            document.getElementById('year').value = '';
            document.getElementById('jenis_industri').value = '';
            document.forms[0].submit();
        }

        // Add validation for date ranges
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const monthSelect = document.getElementById('month');
            const yearSelect = document.getElementById('year');

            // Disable month/year selects if date range is being used
            function toggleDateControls() {
                const usingDateRange = startDateInput.value || endDateInput.value;
                monthSelect.disabled = usingDateRange;
                yearSelect.disabled = usingDateRange;

                if (usingDateRange) {
                    monthSelect.value = '';
                    yearSelect.value = '';
                }
            }

            startDateInput.addEventListener('change', toggleDateControls);
            endDateInput.addEventListener('change', toggleDateControls);

            // Initialize on page load
            toggleDateControls();
        });
    </script>

    <script>
        const pengujiData = @json($pengujiData);
        const statusData = @json($statusData);
        const detailIzinData = @json($detailIzinData);
        const jenisIndustriData = @json($jenisIndustriData);
        const statusPenilaianData = @json($statusPenilaianData);
        const hasilData = @json($hasilData);

        function downloadChart(canvasId, filename) {
            const canvas = document.getElementById(canvasId);
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = filename + '.png';
            link.click();
        }

        new Chart(document.getElementById('frekuensiPengujiChart'), {
            type: 'bar',
            data: {
                labels: pengujiData.map(item => item.nama),
                datasets: [{
                    label: 'Jumlah Frekuensi',
                    data: pengujiData.map(item => item.total),
                    backgroundColor: '#D84343'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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

        new Chart(document.getElementById('statusChart'), {
            type: 'bar',
            data: {
                labels: statusData.map(item => item.status),
                datasets: [{
                    label: 'Jumlah',
                    data: statusData.map(item => item.total),
                    backgroundColor: '#D84343'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        new Chart(document.getElementById('jenisIndustriChart'), {
            type: 'bar',
            data: {
                labels: jenisIndustriData.map(item => item.jenis_industri),
                datasets: [{
                    label: 'Jumlah',
                    data: jenisIndustriData.map(item => item.total),
                    backgroundColor: '#36A2EB'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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

        new Chart(document.getElementById('statusPenilaianChart'), {
            type: 'bar',
            data: {
                labels: statusPenilaianData.map(item => item.status),
                datasets: [{
                    label: 'Jumlah',
                    data: statusPenilaianData.map(item => item.total),
                    backgroundColor: '#D84343'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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

        new Chart(document.getElementById('hasilChart'), {
            type: 'pie',
            data: {
                labels: hasilData.map(item => item.hasil),
                datasets: [{
                    data: hasilData.map(item => item.total),
                    backgroundColor: ['#FF6384', '#36A2EB']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        var ctx = document.getElementById('statusPerizinanChart').getContext('2d');
        var statusPerizinanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($statusPerizinanData->pluck('status_perizinan')),
            datasets: [{
                label: 'Jumlah Status Perizinan',
                data: @json($statusPerizinanData->pluck('total')),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    var ctx = document.getElementById('jenisOutputChart').getContext('2d');
    var jenisOutputChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: @json($jenisOutputData->pluck('jenis_output')),
            datasets: [{
                label: 'Jenis Output',
                data: @json($jenisOutputData->pluck('total')),
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                borderWidth: 1
            }]
        },
        options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
    });

    var ctx = document.getElementById('statusPerizinanDirkomChart').getContext('2d');
        var statusPerizinanDirkomChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($statusPerizinanDirkomData->pluck('status_perizinan')),
            datasets: [{
                label: 'Jumlah Status Perizinan',
                data: @json($statusPerizinanDirkomData->pluck('total')),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    var ctx = document.getElementById('jenisOutputDirkomChart').getContext('2d');
    var jenisOutputDirkomChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: @json($jenisOutputDirkomData->pluck('jenis_output')),
            datasets: [{
                label: 'Jenis Output',
                data: @json($jenisOutputDirkomData->pluck('total')),
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                borderWidth: 1
            }]
        },
        options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
    });
    </script>
@endsection
