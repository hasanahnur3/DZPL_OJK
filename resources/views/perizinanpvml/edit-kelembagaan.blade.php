@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Select the form
        const form = document.querySelector('form');

        // Add event listener to the form
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting by default

            // Show SweetAlert2 confirmation
            Swal.fire({
                title: 'Data berhasil disimpan!',
                text: 'Data Anda telah berhasil dikirim ke server.',
                icon: 'success',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form to the server if "OK" is clicked
                    form.submit();
                }
            });
        });
    });
</script>

<div style="max-width: 800px; margin: auto; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h2>Edit Data Kelembagaan</h2>
    
    <form action="{{ route('kelembagaan.update', $kelembagaan->id) }}" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        @csrf
        @method('PUT')

        <!-- Input Jenis Industri -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="jenis_industri" style="font-weight: bold; color: #555;">Jenis Industri</label>
            <input type="text" class="form-control" id="jenis_industri" name="jenis_industri" value="{{ $kelembagaan->jenis_industri }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        </div>

        <!-- Input Nama Perusahaan -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="nama_perusahaan" style="font-weight: bold; color: #555;">Nama Perusahaan</label>
            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ $kelembagaan->nama_perusahaan }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        </div>

        <!-- Input Detail Izin -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="detail_izin" style="font-weight: bold; color: #555;">Detail Izin</label>
            <input type="text" class="form-control" id="detail_izin" name="detail_izin" value="{{ $kelembagaan->detail_izin }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        </div>

        <!-- Input Status -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="status" style="font-weight: bold; color: #555;">Status</label>
            <select name="status" id="status" class="form-control" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                <option value="Dalam proses analisis" {{ $kelembagaan->status == 'Dalam proses analisis' ? 'selected' : '' }}>Dalam proses analisis</option>
                <option value="Kelengkapan dok" {{ $kelembagaan->status == 'Kelengkapan dok' ? 'selected' : '' }}>Kelengkapan dok</option>
                <option value="Selesai" {{ $kelembagaan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Ditolak/Dikembalikan" {{ $kelembagaan->status == 'Ditolak/Dikembalikan' ? 'selected' : '' }}>Ditolak/Dikembalikan</option>
            </select>
        </div>

        <!-- Input Nomor Surat Permohonan -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="nomor_surat_permohonan" style="font-weight: bold; color: #555;">Nomor Surat Permohonan</label>
            <input type="text" class="form-control" id="nomor_surat_permohonan" name="nomor_surat_permohonan" value="{{ $kelembagaan->nomor_surat_permohonan }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        </div>

        <!-- Input Tanggal Surat Permohonan -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="tanggal_surat_permohonan" style="font-weight: bold; color: #555;">Tanggal Surat Permohonan</label>
            <input type="date" class="form-control" id="tanggal_surat_permohonan" name="tanggal_surat_permohonan" value="{{ $kelembagaan->tanggal_surat_permohonan }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        </div>

        <!-- Input Tanggal Pengajuan Sistem -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="tanggal_pengajuan_sistem" style="font-weight: bold; color: #555;">Tanggal Pengajuan Sistem</label>
            <input type="date" class="form-control" id="tanggal_pengajuan_sistem" name="tanggal_pengajuan_sistem" value="{{ $kelembagaan->tanggal_pengajuan_sistem }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        </div>

        <!-- Input Tanggal Dokumen Lengkap -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="tanggal_dokumen_lengkap" style="font-weight: bold; color: #555;">Tanggal Dokumen Lengkap</label>
            <input type="date" class="form-control" id="tanggal_dokumen_lengkap" name="tanggal_dokumen_lengkap" value="{{ $kelembagaan->tanggal_dokumen_lengkap }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        </div>

        <!-- Input Tanggal Selesai Analisis -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="tanggal_selesai_analisis" style="font-weight: bold; color: #555;">Tanggal Selesai Analisis</label>
            <input type="date" class="form-control" id="tanggal_selesai_analisis" name="tanggal_selesai_analisis" value="{{ $kelembagaan->tanggal_selesai_analisis }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        </div>

        <!-- Input SLA -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="sla" style="font-weight: bold; color: #555;">SLA</label>
            <input type="number" class="form-control" id="sla" name="sla" value="{{ $kelembagaan->sla }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        </div>

        <!-- Input Nomor Surat -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="nomor_surat" style="font-weight: bold; color: #555;">Nomor Surat</label>
            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ $kelembagaan->nomor_surat }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        </div>

        <!-- Input Tanggal Surat -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="tanggal_surat" style="font-weight: bold; color: #555;">Tanggal Surat</label>
            <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="{{ $kelembagaan->tanggal_surat }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        </div>

        <!-- Input Jumlah Hari Kerja -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="jumlah_hari_kerja" style="font-weight: bold; color: #555;">Jumlah Hari Kerja</label>
            <input type="text" class="form-control" id="jumlah_hari_kerja" name="jumlah_hari_kerja" value="{{ $kelembagaan->jumlah_hari_kerja }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        </div>

        <!-- Input Aksi -->
        <div style="display: flex; flex-direction: column; gap:5px;">
            <label for="aksi" style="font-weight: bold; color: #555;">Aksi</label>
            <input type="text" class="form-control" id="aksi" name="aksi" value="{{ $kelembagaan->aksi }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        </div>

        <!-- Update Button -->
        <button type="submit" style="background-color: #A91111; color: white; padding: 1rem; border: none; border-radius: 10px; cursor: pointer; margin-top: 1rem;">Update</button>
    </form>
</div>
@endsection
