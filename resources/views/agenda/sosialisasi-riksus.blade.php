@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agenda Sosialisasi Riksus</h1>

    <!-- Form untuk tambah agenda -->
    <form action="{{ route('sosialisasi-riksus.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="judul_sosialisasi">Judul Sosialisasi</label>
            <input type="text" name="judul_sosialisasi" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="hari_tanggal">Hari/Tanggal</label>
            <input type="date" name="hari_tanggal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tempat">Tempat</label>
            <input type="text" name="tempat" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="keterangan_peserta">Keterangan Peserta</label>
            <textarea name="keterangan_peserta" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="kesimpulan">Kesimpulan</label>
            <textarea name="kesimpulan" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Agenda</button>
    </form>

</div>
@endsection
