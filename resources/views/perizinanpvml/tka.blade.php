@extends('layouts.app')

@section('content')
<div class="form-container">
<div  style="width: 900px; margin: auto; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color:#FFFFFF
">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<h2 style="text-align: center; color: #333; margin-bottom:20px;">Form Pengisian TKA</h2>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Data berhasil disimpan!',
                text: 'Formulir Anda telah berhasil dikirim.',
                icon: 'success',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    </script>

    <form method="POST" action="{{ route('tka.store') }}" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        @csrf
        
        <div style="display: flex; flex-direction: column; gap: 5px;">
            <select id="jenis_industri" name="jenis_industri" required>
                <option value="">Pilih Jenis Industri</option>
                @foreach($jenis_industri as $jenis)
                    <option value="{{ $jenis }}">{{ $jenis }}</option>
                @endforeach
            </select>
            
            <select id="nama_perusahaan" name="nama_perusahaan" required>
                <option value="">Pilih Nama Perusahaan</option>
            </select>
            <script>
                document.getElementById('jenis_industri').addEventListener('change', function() {
                    let jenisIndustri = this.value;
                    fetch(`/get-companies?jenis_industri=${jenisIndustri}`)
                        .then(response => response.json())
                        .then(data => {
                            let namaPerusahaanDropdown = document.getElementById('nama_perusahaan');
                            namaPerusahaanDropdown.innerHTML = '<option value="">Pilih Nama Perusahaan</option>';
                            data.forEach(nama => {
                                let option = document.createElement('option');
                                option.value = nama;
                                option.textContent = nama;
                                namaPerusahaanDropdown.appendChild(option);
                            });
                        });
                });
                </script>

            <label for="nomor_surat_permohonan" style="font-weight: bold; color: #555;">Nomor Surat Permohonan</label>
            <input type="text" name="nomor_surat_permohonan" id="nomor_surat_permohonan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_surat_permohonan" style="font-weight: bold; color: #555;">Tanggal Surat Permohonan</label>
            <input type="date" name="tanggal_surat_permohonan" id="tanggal_surat_permohonan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="status_perizinan" style="font-weight: bold; color: #555;">Status Perizinan</label>
            <select name="status_perizinan" id="status_perizinan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                <option value="Dalam proses analisis">Dalam proses analisis</option>
                <option value="Kelengkapan dok">Kelengkapan dok</option>
                <option value="Selesai">Selesai</option>
                <option value="Ditolak/Dikembalikan">Ditolak/Dikembalikan</option>
            </select>

            <label for="jenis_output" style="font-weight: bold; color: #555;">Jenis Output</label>
            <select name="jenis_output" id="jenis_output" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                <option value="pencatatan">Pencatatan</option>
                <option value="penolakan">Penolakan</option>
            </select>
        </div>

        <div style="display: flex; flex-direction: column; gap: 5px;">
            <label for="tanggal_dok_lengkap" style="font-weight: bold; color: #555;">Tanggal Dokumen Lengkap</label>
            <input type="date" name="tanggal_dok_lengkap" id="tanggal_dok_lengkap" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">


            <label for="no_surat_pencatatan" style="font-weight: bold; color: #555;">No Surat Pencatatan</label>
            <input type="text" name="no_surat_pencatatan" id="no_surat_pencatatan" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_surat_pencatatan" style="font-weight: bold; color: #555;">Tanggal Surat Pencatatan</label>
            <input type="date" name="tanggal_surat_pencatatan" id="tanggal_surat_pencatatan" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="jumlah_hari_kerja" style="font-weight: bold; color: #555;">Jumlah Hari Kerja</label>
            <input type="text" name="jumlah_hari_kerja" id="jumlah_hari_kerja" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <button type="submit" style="background-color: #A91111; color: white; padding: 1rem; border: none; border-radius: 10px; cursor: pointer; margin-top: 1rem;">Simpan</button>
        </div>
    </form>
</div>
</div>
<style>
        .form-container {
        max-width: 100%;
        width: 100%;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: white;
        display: flex;
        justify-content: center;
    }
</style>
@endsection
