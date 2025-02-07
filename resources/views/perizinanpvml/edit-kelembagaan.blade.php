@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Kelembagaan</h2>

    <form action="{{ route('kelembagaan.update', $kelembagaan->id) }}" method="POST">
        @csrf
        @method('PUT')


        <div class="form-group">
            <label for="jenis_industri">Jenis Industri:</label>
            <input type="text" class="form-control" id="jenis_industri" name="jenis_industri" value="{{ $kelembagaan->jenis_industri }}" required>
        </div>

        <div class="form-group">
            <label for="nama_perusahaan">Nama Perusahaan:</label>
            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ $kelembagaan->nama_perusahaan }}" required>
        </div>

        <div class="form-group">
            <label for="detail_izin">Detail Izin:</label>
            <input type="text" class="form-control" id="detail_izin" name="detail_izin" value="{{ $kelembagaan->detail_izin }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="Dalam proses analisis" {{ $kelembagaan->status == 'Dalam proses analisis' ? 'selected' : '' }}>Dalam proses analisis</option>
                <option value="Kelengkapan dok" {{ $kelembagaan->status == 'Kelengkapan dok' ? 'selected' : '' }}>Kelengkapan dok</option>
                <option value="Selesai" {{ $kelembagaan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Ditolak/Dikembalikan" {{ $kelembagaan->status == 'Ditolak/Dikembalikan' ? 'selected' : '' }}>Ditolak/Dikembalikan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nomor_surat_permohonan">Nomor Surat Permohonan:</label>
            <input type="text" class="form-control" id="nomor_surat_permohonan" name="nomor_surat_permohonan" value="{{ $kelembagaan->nomor_surat_permohonan }}">
        </div>

        <div class="form-group">
            <label for="tanggal_surat_permohonan">Tanggal Surat Permohonan:</label>
            <input type="date" class="form-control" id="tanggal_surat_permohonan" name="tanggal_surat_permohonan" value="{{ $kelembagaan->tanggal_surat_permohonan }}">
        </div>

        <div class="form-group">
            <label for="tanggal_pengajuan_sistem">Tanggal Pengajuan Sistem:</label>
            <input type="date" class="form-control" id="tanggal_pengajuan_sistem" name="tanggal_pengajuan_sistem" value="{{ $kelembagaan->tanggal_pengajuan_sistem }}">
        </div>

        <div class="form-group">
            <label for="tanggal_dokumen_lengkap">Tanggal Dokumen Lengkap:</label>
            <input type="date" class="form-control" id="tanggal_dokumen_lengkap" name="tanggal_dokumen_lengkap" value="{{ $kelembagaan->tanggal_dokumen_lengkap }}">
        </div>

        <div class="form-group">
            <label for="tanggal_selesai_analisis">Tanggal Selesai Analisis:</label>
            <input type="date" class="form-control" id="tanggal_selesai_analisis" name="tanggal_selesai_analisis" value="{{ $kelembagaan->tanggal_selesai_analisis }}">
        </div>

        <div class="form-group">
            <label for="sla">SLA:</label>
            <input type="number" class="form-control" id="sla" name="sla" value="{{ $kelembagaan->sla }}">
        </div>

        <div class="form-group">
            <label for="nomor_surat">Nomor Surat:</label>
            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ $kelembagaan->nomor_surat }}">
        </div>

        <div class="form-group">
            <label for="tanggal_surat">Tanggal Surat:</label>
            <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="{{ $kelembagaan->tanggal_surat }}">
        </div>

        <div class="form-group">
            <label for="jumlah_hari_kerja">Jumlah Hari Kerja:</label>
            <input type="text" class="form-control" id="jumlah_hari_kerja" name="jumlah_hari_kerja" value="{{ $kelembagaan->jumlah_hari_kerja }}">
        </div>

        <div class="form-group">
            <label for="aksi">Aksi:</label>
            <input type="text" class="form-control" id="aksi" name="aksi" value="{{ $kelembagaan->aksi }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
