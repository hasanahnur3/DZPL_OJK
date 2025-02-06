<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Panels</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Daftar Forum Panels</h2>
        
        <!-- Tombol untuk menuju halaman tambah forum panel -->
        <a href="{{ route('forum-panel.create') }}" class="btn btn-primary mb-3">Tambah Forum Panel</a>

        <!-- Menampilkan tabel forum panel -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Perusahaan</th>
                    <th>Hari Pelaksanaan</th>
                    <th>Waktu</th>
                    <th>Tempat Pelaksanaan</th>
                    <th>Kriteria</th>
                    <th>Jenis Industri</th>
                    <th>Hasil</th>
                    <th>Aksi</th> <!-- Tambahkan kolom aksi -->
                </tr>
            </thead>
            <tbody>
                @foreach($forumPanels as $index => $panel)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $panel->nama_perusahaan }}</td>
                    <td>{{ $panel->hari_pelaksanaan }}</td>
                    <td>{{ $panel->waktu }}</td>
                    <td>{{ $panel->tempat_pelaksanaan }}</td>
                    <td>{{ $panel->kriteria }}</td>
                    <td>{{ $panel->jenis_industri }}</td>
                    <td>{{ $panel->hasil }}</td>
                    <td>
                        <a href="{{ route('forum-panel.edit', $panel->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
