@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <h2>Grafik Industri Berdasarkan Perusahaan</h2>
    <canvas id="industryChart"></canvas>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ url('/chart-data') }}")
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => item.jenis_industri);
                    const values = data.map(item => item.total);

                    const ctx = document.getElementById('industryChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Jumlah Perusahaan',
                                data: values,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        });
    </script>

@endsection