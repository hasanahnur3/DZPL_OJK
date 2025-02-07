@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Kelembagaan PVML</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kelembagaan.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="jenis_industri">Jenis Industri</label>
                    <input type="text" class="form-control" id="jenis_industri" name="jenis_industri" required value="{{ old('jenis_industri') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="nama_perusahaan">Nama Perusahaan</label>
                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required value="{{ old('nama_perusahaan') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="detail_izin">Detail Izin</label>
                    <input type="text" class="form-control" id="detail_izin" name="detail_izin" value="{{ old('detail_izin') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" name="status" required value="{{ old('status') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="nomor_surat_permohonan">Nomor Surat Permohonan</label>
                    <input type="text" class="form-control" id="nomor_surat_permohonan" name="nomor_surat_permohonan" value="{{ old('nomor_surat_permohonan') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="tanggal_surat_permohonan">Tanggal Surat Permohonan</label>
                    <input type="date" class="form-control" id="tanggal_surat_permohonan" name="tanggal_surat_permohonan" value="{{ old('tanggal_surat_permohonan') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="tanggal_pengajuan_sistem">Tanggal Pengajuan Sistem</label>
                    <input type="date" class="form-control" id="tanggal_pengajuan_sistem" name="tanggal_pengajuan_sistem" value="{{ old('tanggal_pengajuan_sistem') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="tanggal_dokumen_lengkap">Tanggal Dokumen Lengkap</label>
                    <input type="date" class="form-control" id="tanggal_dokumen_lengkap" name="tanggal_dokumen_lengkap" value="{{ old('tanggal_dokumen_lengkap') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="tanggal_selesai_analisis">Tanggal Selesai Analisis</label>
                    <input type="date" class="form-control" id="tanggal_selesai_analisis" name="tanggal_selesai_analisis" value="{{ old('tanggal_selesai_analisis') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="sla">SLA</label>
                    <input type="number" class="form-control" id="sla" name="sla" value="{{ old('sla') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="nomor_surat">Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="tanggal_surat">Tanggal Surat</label>
                    <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="jumlah_hari_kerja">Jumlah Hari Kerja</label>
                    <input type="text" class="form-control" id="jumlah_hari_kerja" name="jumlah_hari_kerja" value="{{ old('jumlah_hari_kerja') }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kelembagaan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection