@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Form Kelembagaan PVML</h2>

        @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Kelembagaan</h2>

    <form action="{{ route('kelembagaan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="jenis_industri">Jenis Industri:</label>
            <input type="text" class="form-control" id="jenis_industri" name="jenis_industri" required>
        </div>

        <div class="form-group">
            <label for="nama_perusahaan">Nama Perusahaan:</label>
            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
        </div>

        <div class="form-group">
            <label for="detail_izin">Detail Izin:</label>
            <input type="text" class="form-control" id="detail_izin" name="detail_izin" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Dalam proses analisis">Dalam proses analisis</option>
                <option value="Kelengkapan dok">Kelengkapan dok</option>
                <option value="Selesai">Selesai</option>
                <option value="Ditolak/Dikembalikan">Ditolak/Dikembalikan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nomor_surat_permohonan">Nomor Surat Permohonan:</label>
            <input type="text" class="form-control" id="nomor_surat_permohonan" name="nomor_surat_permohonan">
        </div>

        <div class="form-group">
            <label for="tanggal_surat_permohonan">Tanggal Surat Permohonan:</label>
            <input type="date" class="form-control" id="tanggal_surat_permohonan" name="tanggal_surat_permohonan">
        </div>

        <div class="form-group">
            <label for="tanggal_pengajuan_sistem">Tanggal Pengajuan Sistem:</label>
            <input type="date" class="form-control" id="tanggal_pengajuan_sistem" name="tanggal_pengajuan_sistem">
        </div>

        <div class="form-group">
            <label for="tanggal_dokumen_lengkap">Tanggal Dokumen Lengkap:</label>
            <input type="date" class="form-control" id="tanggal_dokumen_lengkap" name="tanggal_dokumen_lengkap">
        </div>

        <div class="form-group">
            <label for="tanggal_selesai_analisis">Tanggal Selesai Analisis:</label>
            <input type="date" class="form-control" id="tanggal_selesai_analisis" name="tanggal_selesai_analisis">
        </div>

        <div class="form-group">
            <label for="sla">SLA (Hari):</label>
            <input type="number" class="form-control" id="sla" name="sla">
        </div>

        <div class="form-group">
            <label for="nomor_surat">Nomor Surat:</label>
            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat">
        </div>

        <div class="form-group">
            <label for="tanggal_surat">Tanggal Surat:</label>
            <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat">
        </div>

        <div class="form-group">
            <label for="jumlah_hari_kerja">Jumlah Hari Kerja:</label>
            <input type="number" class="form-control" id="jumlah_hari_kerja" name="jumlah_hari_kerja">
        </div>

        <div class="form-group">
            <label for="aksi">Aksi:</label>
            <input type="text" class="form-control" id="aksi" name="aksi">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <a href="{{ route('kelembagaan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection

    </div>
@endsection
