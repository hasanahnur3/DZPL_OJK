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
    <div style="width: 800px; height:auto; margin: auto; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); ">
        <h2 style="text-align:center; margin-bottom:20px;">Edit Data TKA</h2>
        <form action="{{ route('tka.update', $tka->id) }}" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            @csrf
            @method('POST')

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
                <input type="text" name="nomor_surat_permohonan" id="nomor_surat_permohonan" value="{{ $tka->nomor_surat_permohonan }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                <label for="tanggal_surat_permohonan" style="font-weight: bold; color: #555;">Tanggal Surat Permohonan</label>
                <input type="date" name="tanggal_surat_permohonan" id="tanggal_surat_permohonan" value="{{ $tka->tanggal_surat_permohonan }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                <label for="status_perizinan" style="font-weight: bold; color: #555;">Status Perizinan</label>
                <select name="status_perizinan" id="status_perizinan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                    <option value="Dalam proses analisis" {{ $tka->status_perizinan == 'Dalam proses analisis' ? 'selected' : '' }}>Dalam proses analisis</option>
                    <option value="Kelengkapan dok" {{ $tka->status_perizinan == 'Kelengkapan dok' ? 'selected' : '' }}>Kelengkapan dok</option>
                    <option value="Selesai" {{ $tka->status_perizinan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Ditolak/Dikembalikan" {{ $tka->status_perizinan == 'Ditolak/Dikembalikan' ? 'selected' : '' }}>Ditolak/Dikembalikan</option>
                </select>
            </div>

            <div style="display: flex; flex-direction: column; gap: 5px;">



                <label for="jenis_output" style="font-weight: bold; color: #555;">Jenis Output</label>
                <select name="jenis_output" id="jenis_output" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                    <option value="pencatatan" {{ $tka->jenis_output == 'pencatatan' ? 'selected' : '' }}>Pencatatan</option>
                    <option value="penolakan" {{ $tka->jenis_output == 'penolakan' ? 'selected' : '' }}>Penolakan</option>
                </select>

                <label for="tanggal_dok_lengkap" style="font-weight: bold; color: #555;">Tanggal Dokumen Lengkap</label>
                <input type="date" name="tanggal_dok_lengkap" id="tanggal_dok_lengkap" value="{{ $tka->tanggal_dok_lengkap }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                <label for="no_surat_pencatatan" style="font-weight: bold; color: #555;">Nomor Surat Pencatatan / Penolakan</label>
                <input type="text" name="no_surat_pencatatan" id="no_surat_pencatatan" value="{{ $tka->no_surat_pencatatan }}" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                <label for="tanggal_surat_pencatatan" style="font-weight: bold; color: #555;">Tanggal Surat Pencatatan / Penolakan</label>
                <input type="date" name="tanggal_surat_pencatatan" id="tanggal_surat_pencatatan" value="{{ $tka->tanggal_surat_pencatatan }}" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                <button type="submit" style="background-color: #A91111; color: white; padding: 1rem; border: none; border-radius: 10px; cursor: pointer; margin-top: 1rem;">Update</button>
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
