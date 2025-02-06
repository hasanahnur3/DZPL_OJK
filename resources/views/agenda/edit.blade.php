@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Agenda Sosialisasi Riksus</h1>

    <!-- Form untuk edit agenda SOSIALISASI RIKSUS -->
    <form action="{{ route('sosialisasi-riksus.update', $agenda->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menyatakan bahwa ini adalah request PUT untuk update -->
        
        <div class="form-group">
            <label for="judul_sosialisasi">Judul Sosialisasi</label>
            <input type="text" name="judul_sosialisasi" class="form-control" value="{{ old('judul_sosialisasi', $agenda->judul_sosialisasi) }}" required>
        </div>
        <div class="form-group">
            <label for="hari_tanggal">Hari/Tanggal</label>
            <input type="date" name="hari_tanggal" class="form-control" value="{{ old('hari_tanggal', $agenda->hari_tanggal) }}" required>
        </div>
        <div class="form-group">
            <label for="tempat">Tempat</label>
            <input type="text" name="tempat" class="form-control" value="{{ old('tempat', $agenda->tempat) }}" required>
        </div>
        <div class="form-group">
            <label for="keterangan_peserta">Keterangan Peserta</label>
            <textarea name="keterangan_peserta" class="form-control" required>{{ old('keterangan_peserta', $agenda->keterangan_peserta) }}</textarea>
        </div>
        <div class="form-group">
            <label for="kesimpulan">Kesimpulan</label>
            <textarea name="kesimpulan" class="form-control" required>{{ old('kesimpulan', $agenda->kesimpulan) }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Agenda</button>
    </form>
</div>
@endsection
