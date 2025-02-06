@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Edit Penilaian Kemampuan & Kepatutan</h2>

    <form method="POST" action="{{ route('pkk.update', $data->id) }}">
        @csrf
        @method('PUT')

        <label for="jenis_industri" style="font-weight: bold; color: #555;">Jenis Industri</label>
        <select name="jenis_industri" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <option value="Perusahaan Pembiayaan" {{ $data->jenis_industri == 'Perusahaan Pembiayaan' ? 'selected' : '' }}>Perusahaan Pembiayaan</option>
            <option value="PPBTI" {{ $data->jenis_industri == 'PPBTI' ? 'selected' : '' }}>PPBTI</option>
            <option value="Perusahaan Modal Ventura" {{ $data->jenis_industri == 'Perusahaan Modal Ventura' ? 'selected' : '' }}>Perusahaan Modal Ventura</option>
            <option value="Lembaga Keuangan Mikro" {{ $data->jenis_industri == 'Lembaga Keuangan Mikro' ? 'selected' : '' }}>Lembaga Keuangan Mikro</option>
            <option value="Pergadaian" {{ $data->jenis_industri == 'Pergadaian' ? 'selected' : '' }}>Pergadaian</option>
        </select>

        <label for="nama_perusahaan" style="font-weight: bold; color: #555;">Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $data->nama_perusahaan) }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="nama_pihak_utama" style="font-weight: bold; color: #555;">Nama Pihak Utama</label>
        <input type="text" name="nama_pihak_utama" value="{{ old('nama_pihak_utama', $data->nama_pihak_utama) }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="jabatan" style="font-weight: bold; color: #555;">Jabatan</label>
        <select name="jabatan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <option value="Direktur Utama" {{ $data->jabatan == 'Direktur Utama' ? 'selected' : '' }}>Direktur Utama</option>
            <option value="Direktur" {{ $data->jabatan == 'Direktur' ? 'selected' : '' }}>Direktur</option>
            <option value="Komisaris Utama" {{ $data->jabatan == 'Komisaris Utama' ? 'selected' : '' }}>Komisaris Utama</option>
        </select>

        <label for="status" style="font-weight: bold; color: #555;">Status</label>
        <select name="status" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <option value="Sudah diajukan" {{ $data->status == 'Sudah diajukan' ? 'selected' : '' }}>Sudah diajukan</option>
            <option value="Dokumen perlu dilengkapi" {{ $data->status == 'Dokumen perlu dilengkapi' ? 'selected' : '' }}>Dokumen perlu dilengkapi</option>
            <option value="Dokumen sudah diverifikasi" {{ $data->status == 'Dokumen sudah diverifikasi' ? 'selected' : '' }}>Dokumen sudah diverifikasi</option>
        </select>

        <label for="nomor_surat_permohonan" style="font-weight: bold; color: #555;">Nomor Surat Permohonan</label>
        <input type="text" name="nomor_surat_permohonan" value="{{ old('nomor_surat_permohonan', $data->nomor_surat_permohonan) }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="tanggal_surat_permohonan" style="font-weight: bold; color: #555;">Tanggal Surat Permohonan</label>
        <input type="date" name="tanggal_surat_permohonan" value="{{ old('tanggal_surat_permohonan', $data->tanggal_surat_permohonan) }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="tanggal_pengajuan_sistem" style="font-weight: bold; color: #555;">Tanggal Pengajuan Sistem</label>
        <input type="date" name="tanggal_pengajuan_sistem" value="{{ old('tanggal_pengajuan_sistem', $data->tanggal_pengajuan_sistem) }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="tanggal_dok_lengkap" style="font-weight: bold; color: #555;">Tanggal Dok Lengkap</label>
        <input type="date" name="tanggal_dok_lengkap" value="{{ old('tanggal_dok_lengkap', $data->tanggal_dok_lengkap) }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="perlu_klarifikasi" style="font-weight: bold; color: #555;">Perlu Klarifikasi</label>
        <select name="perlu_klarifikasi" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <option value="iya" {{ $data->perlu_klarifikasi == 'iya' ? 'selected' : '' }}>Iya</option>
            <option value="tidak" {{ $data->perlu_klarifikasi == 'tidak' ? 'selected' : '' }}>Tidak</option>
        </select>

        <label for="tanggal_klarifikasi" style="font-weight: bold; color: #555;">Tanggal Klarifikasi</label>
        <input type="date" name="tanggal_klarifikasi" value="{{ old('tanggal_klarifikasi', $data->tanggal_klarifikasi) }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="hasil" style="font-weight: bold; color: #555;">Hasil</label>
        <select name="hasil" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
            <option value="direkomendasikan" {{ $data->hasil == 'direkomendasikan' ? 'selected' : '' }}>Direkomendasikan</option>
            <option value="tidak direkomendasikan" {{ $data->hasil == 'tidak direkomendasikan' ? 'selected' : '' }}>Tidak Direkomendasikan</option>
        </select>

        <label for="nomor_persetujuan" style="font-weight: bold; color: #555;">Nomor Persetujuan</label>
        <input type="text" name="nomor_persetujuan" value="{{ old('nomor_persetujuan', $data->nomor_persetujuan) }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="tanggal_persetujuan" style="font-weight: bold; color: #555;">Tanggal Persetujuan</label>
        <input type="date" name="tanggal_persetujuan" value="{{ old('tanggal_persetujuan', $data->tanggal_persetujuan) }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <label for="jumlah_hari_kerja" style="font-weight: bold; color: #555;">Jumlah Hari Kerja</label>
        <input type="number" name="jumlah_hari_kerja" value="{{ old('jumlah_hari_kerja', $data->jumlah_hari_kerja) }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
