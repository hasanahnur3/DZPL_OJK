@extends('layouts.app')

@section('content')
    <h1>Tambah Forum Panel</h1>

    <!-- Form untuk menambah forum panel -->
    <form action="{{ route('forum-panel.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Perusahaan:</label>
            <input type="text" name="nama_perusahaan" class="form-control" required><br>
        </div>

        <div class="mb-3">
            <label>Hari Pelaksanaan:</label>
            <input type="date" name="hari_pelaksanaan" class="form-control" required><br>
        </div>

        <div class="mb-3">
            <label>Waktu:</label>
            <input type="time" name="waktu" class="form-control" required><br>
        </div>

        <div class="mb-3">
            <label>Tempat Pelaksanaan:</label>
            <input type="text" name="tempat_pelaksanaan" class="form-control" required><br>
        </div>

        <div class="mb-3">
            <label>Kriteria:</label>
            <textarea name="kriteria" class="form-control" required></textarea><br>
        </div>

        <div class="mb-3">
            <label>Jenis Industri:</label>
            <input type="text" name="jenis_industri" class="form-control" required><br>
        </div>

        <div class="mb-3">
            <label>Hasil:</label>
            <textarea name="hasil" class="form-control" required></textarea><br>
        </div>

        <button type="submit" class="btn btn-success">Tambah Forum Panel</button>
    </form>

@endsection
