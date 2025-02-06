@extends('layouts.app')

@section('content')
<form action="{{ route('forum-panel.update', $forumPanel->id) }}" method="POST">
    @csrf
    @method('PUT')  <!-- Pastikan method PUT ada di sini -->
 <!-- Pastikan menggunakan method PUT untuk update -->

    <label>Nama Perusahaan:</label>
    <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $forumPanel->nama_perusahaan) }}" required><br>

    <label>Hari Pelaksanaan:</label>
    <input type="date" name="hari_pelaksanaan" value="{{ old('hari_pelaksanaan', $forumPanel->hari_pelaksanaan) }}" required><br>

    <label>Waktu:</label>
    <input type="time" name="waktu" value="{{ old('waktu', $forumPanel->waktu) }}" required><br>

    <label>Tempat Pelaksanaan:</label>
    <input type="text" name="tempat_pelaksanaan" value="{{ old('tempat_pelaksanaan', $forumPanel->tempat_pelaksanaan) }}" required><br>

    <label>Kriteria:</label>
    <textarea name="kriteria" required>{{ old('kriteria', $forumPanel->kriteria) }}</textarea><br>

    <label>Jenis Industri:</label>
    <input type="text" name="jenis_industri" value="{{ old('jenis_industri', $forumPanel->jenis_industri) }}" required><br>

    <label>Hasil:</label>
    <textarea name="hasil" required>{{ old('hasil', $forumPanel->hasil) }}</textarea><br>

    <button type="submit">Update Forum Panel</button>
</form>
@endsection
