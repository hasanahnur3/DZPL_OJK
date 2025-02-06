@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 800px; margin: auto; padding: 2rem; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Tambah Daftar Penilaian Kemampuan & Kepatutan</h2><br><br>
    
    @if(session('success'))
        <div class="alert alert-success" style="background-color: #28a745; color: white; padding: 0.75rem; border-radius: 4px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('pkk.store') }}" style="display: flex; flex-direction: column; gap: 1rem;">
        @csrf

        <label for="jenis_industri" style="font-weight: bold; color: #555;">Jenis Industri</label>
        <select name="jenis_industri" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <option value="Perusahaan Pembiayaan">Perusahaan Pembiayaan</option>
            <option value="PPBTI">PPBTI</option>
            <option value="Perusahaan Modal Ventura">Perusahaan Modal Ventura</option>
            <option value="Lembaga Keuangan Mikro">Lembaga Keuangan Mikro</option>
            <option value="Pergadaian">Pergadaian</option>
        </select>

        <label for="nama_perusahaan" style="font-weight: bold; color: #555;">Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="nama_pihak_utama" style="font-weight: bold; color: #555;">Nama Pihak Utama</label>
        <input type="text" name="nama_pihak_utama" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="jabatan" style="font-weight: bold; color: #555;">Jabatan</label>
        <select name="jabatan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <option value="Direktur Utama">Direktur Utama</option>
            <option value="Direktur">Direktur</option>
            <option value="Komisaris Utama">Komisaris Utama</option>
        </select>

        <label for="status" style="font-weight: bold; color: #555;">Status</label>
        <select name="status" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <option value="Sudah diajukan">Sudah diajukan</option>
            <option value="Dokumen perlu dilengkapi">Dokumen perlu dilengkapi</option>
            <option value="Dokumen sudah diverifikasi">Dokumen sudah diverifikasi</option>
        </select>

        <label for="nomor_surat_permohonan" style="font-weight: bold; color: #555;">Nomor Surat Permohonan</label>
        <input type="text" name="nomor_surat_permohonan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="tanggal_surat_permohonan" style="font-weight: bold; color: #555;">Tanggal Surat Permohonan</label>
        <input type="date" name="tanggal_surat_permohonan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="tanggal_pengajuan_sistem" style="font-weight: bold; color: #555;">Tanggal Pengajuan Sistem</label>
        <input type="date" name="tanggal_pengajuan_sistem" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="tanggal_dok_lengkap" style="font-weight: bold; color: #555;">Tanggal Dok Lengkap</label>
        <input type="date" name="tanggal_dok_lengkap" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="perlu_klarifikasi" style="font-weight: bold; color: #555;">Perlu Klarifikasi</label>
        <select name="perlu_klarifikasi" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <option value="iya">Iya</option>
            <option value="tidak">Tidak</option>
        </select>

        <label for="tanggal_klarifikasi" style="font-weight: bold; color: #555;">Tanggal Klarifikasi</label>
        <input type="date" name="tanggal_klarifikasi" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="hasil" style="font-weight: bold; color: #555;">Hasil</label>
        <select name="hasil" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <option value="direkomendasikan">Direkomendasikan</option>
            <option value="tidak direkomendasikan">Tidak Direkomendasikan</option>
        </select>

        <label for="nomor_persetujuan" style="font-weight: bold; color: #555;">Nomor Persetujuan</label>
        <input type="text" name="nomor_persetujuan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="tanggal_persetujuan" style="font-weight: bold; color: #555;">Tanggal Persetujuan</label>
        <input type="date" name="tanggal_persetujuan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="jumlah_hari_kerja" style="font-weight: bold; color: #555;">Jumlah Hari Kerja</label>
        <input type="number" name="jumlah_hari_kerja" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <button type="submit" style="background-color: #007bff; color: white; padding: 1rem; border: none; border-radius: 4px; cursor: pointer; margin-top: 1rem;">Simpan</button>
    </form>
</div>
@endsection
