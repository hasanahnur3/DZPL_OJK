@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Seleksi form
    const form = document.querySelector('form');

    // Tambahkan event listener ke form
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Mencegah pengiriman form secara default

        // Tampilkan SweetAlert2
        Swal.fire({
            title: 'Data berhasil disimpan!',
            text: 'Data Anda telah berhasil dikirim ke server.',
            icon: 'success',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim form ke server jika tombol "OK" diklik
                form.submit();
            }
        });
    });
});
</script>
<div class="form-container">
<div style="width: 800px; height:auto; margin: auto; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #ffffff; ">
    <h2 style="text-align: center; color: #333;">Edit Daftar Direksi Komisaris</h2>
    <form action="{{ route('dirkom.update', $dirkom->id) }}" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        @csrf
        @method('PUT')

        <div style="display: flex; flex-direction: column; gap: 5px; margin-top: 20px;">

            <select id="jenis_industri" name="jenis_industri" required style="height:35px;">
                <option value="">Pilih Jenis Industri</option>
                @foreach($jenis_industri as $jenis)
                    <option value="{{ $jenis }}" {{ old('jenis_industri', $dirkom->jenis_industri) == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                @endforeach
            </select>
            
            <select id="nama_perusahaan" name="nama_perusahaan" required style="height:35px;">
                @foreach($nama_perusahaan as $nama)
                <option value="{{ $nama }}" {{ old('nama_perusahaan', $dirkom->nama_perusahaan) == $nama ? 'selected' : '' }}>{{ $nama }}</option>
            @endforeach
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
            <input type="text" id="nomor_surat_permohonan" name="nomor_surat_permohonan" value="{{ old('nomor_surat_permohonan', $dirkom->nomor_surat_permohonan) }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_surat_permohonan" style="font-weight: bold; color: #555;">Tanggal Surat Permohonan</label>
            <input type="date" id="tanggal_surat_permohonan" name="tanggal_surat_permohonan" value="{{ old('tanggal_surat_permohonan', \Carbon\Carbon::parse($dirkom->tanggal_surat_permohonan)->format('Y-m-d')) }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="status_perizinan" style="font-weight: bold; color: #555;">Status Perizinan</label>
            <select id="status_perizinan" name="status_perizinan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                <option value="Dalam proses analisis" {{ $dirkom->status_perizinan == 'Dalam proses analisis' ? 'selected' : '' }}>Dalam proses analisis</option>
                <option value="Kelengkapan dok" {{ $dirkom->status_perizinan == 'Kelengkapan dok' ? 'selected' : '' }}>Kelengkapan dok</option>
                <option value="Selesai" {{ $dirkom->status_perizinan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Ditolak / dikembalikkan" {{ $dirkom->status_perizinan == 'Ditolak / dikembalikkan' ? 'selected' : '' }}>Ditolak / dikembalikkan</option>
            </select>
        </div>

        <div style="display: flex; flex-direction: column; gap: 5px;">
            <label for="jenis_output" style="font-weight: bold; color: #555;">Jenis Output</label>
            <select id="jenis_output" name="jenis_output" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                <option value="pencatatan" {{ $dirkom->jenis_output == 'pencatatan' ? 'selected' : '' }}>Pencatatan</option>
                <option value="penolakan" {{ $dirkom->jenis_output == 'penolakan' ? 'selected' : '' }}>Penolakan</option>
            </select>

            <label for="tanggal_dok_lengkap" style="font-weight: bold; color: #555;">Tanggal Dokumen Lengkap</label>
<input type="date" id="tanggal_dok_lengkap" name="tanggal_dok_lengkap" value="{{ old('tanggal_dok_lengkap', $dirkom->tanggal_dok_lengkap ? \Carbon\Carbon::parse($dirkom->tanggal_dok_lengkap)->format('Y-m-d') : '') }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">


            <label for="no_surat_pencatatan" style="font-weight: bold; color: #555;">Nomor Surat Pencatatan</label>
            <input type="text" id="no_surat_pencatatan" name="no_surat_pencatatan" value="{{ old('no_surat_pencatatan', $dirkom->no_surat_pencatatan) }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_surat_pencatatan" style="font-weight: bold; color: #555;">Tanggal Surat Pencatatan</label>
            <input type="date" id="tanggal_surat_pencatatan" name="tanggal_surat_pencatatan" value="{{ old('tanggal_surat_pencatatan', $dirkom->tanggal_surat_pencatatan ? \Carbon\Carbon::parse($dirkom->tanggal_surat_pencatatan)->format('Y-m-d') : '') }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <button type="submit" style="background-color: #A91111; color: white; padding: 1rem; border: none; border-radius: 10px; cursor: pointer; margin-top: 1rem;">Update</button>
        </div>
    </form>
</div>
</div>
<style>
        html,
        body {
            height: 100%;
            overflow: hidden;
            /* Menonaktifkan scroll */
            margin: 0;
        }


        .form-container {
            height: 85vh;
            max-width: 100%;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
            display: flex;
            justify-content: center;
        } 
</style>
@endsection
