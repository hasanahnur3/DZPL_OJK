@extends('layouts.app')

@section('content')
    <h1>Edit Data TKA</h1>

    <form action="{{ route('tka.update', $tka->id) }}" method="POST">
        @csrf
        @method('POST')
        
        <label for="jenis_industri">Jenis Industri:</label>
        <input type="text" name="jenis_industri" id="jenis_industri" value="{{ $tka->jenis_industri }}" required><br><br>

        <label for="nama_perusahaan">Nama Perusahaan:</label>
        <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="{{ $tka->nama_perusahaan }}" required><br><br>

        <label for="nomor_surat_permohonan">Nomor Surat Permohonan:</label>
        <input type="text" name="nomor_surat_permohonan" id="nomor_surat_permohonan" value="{{ $tka->nomor_surat_permohonan }}" required><br><br>

        <label for="tanggal_surat_permohonan">Tanggal Surat Permohonan:</label>
        <input type="date" name="tanggal_surat_permohonan" id="tanggal_surat_permohonan" value="{{ $tka->tanggal_surat_permohonan }}" required><br><br>

        <label for="status_perizinan">Status Perizinan:</label>
        <select name="status_perizinan" id="status_perizinan" required>
            <option value="Dalam proses analisis" {{ $tka->status_perizinan == 'Dalam proses analisis' ? 'selected' : '' }}>Dalam proses analisis</option>
            <option value="Kelengkapan dok" {{ $tka->status_perizinan == 'Kelengkapan dok' ? 'selected' : '' }}>Kelengkapan dok</option>
            <option value="Selesai" {{ $tka->status_perizinan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="Ditolak/Dikembalikan" {{ $tka->status_perizinan == 'Ditolak/Dikembalikan' ? 'selected' : '' }}>Ditolak/Dikembalikan</option>
        </select><br><br>

        <label for="jenis_output">Jenis Output:</label>
        <select name="jenis_output" id="jenis_output" required>
            <option value="pencatatan" {{ $tka->jenis_output == 'pencatatan' ? 'selected' : '' }}>Pencatatan</option>
            <option value="penolakan" {{ $tka->jenis_output == 'penolakan' ? 'selected' : '' }}>Penolakan</option>
        </select><br><br>

        <label for="tanggal_dok_lengkap">Tanggal Dokumen Lengkap:</label>
        <input type="date" name="tanggal_dok_lengkap" id="tanggal_dok_lengkap" value="{{ $tka->tanggal_dok_lengkap }}"><br><br>

        <label for="no_surat_pencatatan">No Surat Pencatatan:</label>
        <input type="text" name="no_surat_pencatatan" id="no_surat_pencatatan" value="{{ $tka->no_surat_pencatatan }}"><br><br>

        <label for="tanggal_surat_pencatatan">Tanggal Surat Pencatatan:</label>
        <input type="date" name="tanggal_surat_pencatatan" id="tanggal_surat_pencatatan" value="{{ $tka->tanggal_surat_pencatatan }}"><br><br>

        <label for="jumlah_hari_kerja">Jumlah Hari Kerja:</label>
        <input type="text" name="jumlah_hari_kerja" id="jumlah_hari_kerja" value="{{ $tka->jumlah_hari_kerja }}"><br><br>

        <button type="submit">Update</button>
    </form>
@endsection
