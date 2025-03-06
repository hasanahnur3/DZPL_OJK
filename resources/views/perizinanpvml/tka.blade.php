@extends('layouts.app')

@section('content')
    <div class="form-container">
        <div
            style="width: 800px; margin: auto; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); background-color:#FFFFFF">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <h2 style="text-align: center; color: #333; margin-bottom:40px; margin-top:-10px;">Form Pengisian TKA</h2>

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

            <form method="POST" action="{{ route('tka.store') }}"
                style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                @csrf

                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label for="jenis_industri" style="font-weight: bold; color: #555;">Jenis Industri</label>
                        <select id="jenis_industri" name="jenis_industri" required
                            style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                            <option value="">Pilih Jenis Industri</option>
                            @foreach($jenis_industri as $jenis)
                                <option value="{{ $jenis }}">{{ $jenis }}</option>
                            @endforeach
                        </select>

                        <label for="nama_perusahaan" style="font-weight: bold; color: #555;">Nama Perusahaan</label>
                        <select id="nama_perusahaan" name="nama_perusahaan" required
                            style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                            <option value="">Pilih Nama Perusahaan</option>
                        </select>
                    </div>
                    <script>
                        document.getElementById('jenis_industri').addEventListener('change', function () {
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

                    <label for="nomor_surat_permohonan" style="font-weight: bold; color: #555;">Nomor Surat
                        Permohonan</label>
                    <input type="text" name="nomor_surat_permohonan" id="nomor_surat_permohonan" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                    <label for="tanggal_surat_permohonan" style="font-weight: bold; color: #555;">Tanggal Surat
                        Permohonan</label>
                    <input type="date" name="tanggal_surat_permohonan" id="tanggal_surat_permohonan" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                    <label for="status_perizinan" style="font-weight: bold; color: #555;">Status Perizinan</label>
                    <select name="status_perizinan" id="status_perizinan" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                        <option value="Dalam proses analisis">Dalam proses analisa</option>
                        <option value="Kelengkapan dok">Kelengkapan dok</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Ditolak/Dikembalikan">Ditolak/Dikembalikan</option>
                        <option value="Ditoanggapi">Ditanggapi</option>
                    </select>


                </div>

                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label for="jenis_output" style="font-weight: bold; color: #555;">Jenis Output</label>
                    <select name="jenis_output" id="jenis_output" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                        <option value="pencatatan">Surat Pencatatan</option>
                        <option value="penolakan">Surat Penolakan</option>
                    </select>

                    <label for="tanggal_dok_lengkap" style="font-weight: bold; color: #555;">Tanggal Dokumen Lengkap</label>
                    <input type="date" name="tanggal_dok_lengkap" id="tanggal_dok_lengkap"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">


                    <label for="no_surat_pencatatan" style="font-weight: bold; color: #555;">No Surat Tanggapan</label>
                    <input type="text" name="no_surat_pencatatan" id="no_surat_pencatatan"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                    <label for="tanggal_surat_pencatatan" style="font-weight: bold; color: #555;">Tanggal Surat
                        Tanggapan</label>
                    <input type="date" name="tanggal_surat_pencatatan" id="tanggal_surat_pencatatan"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                    <button type="submit"
                        style="background-color: #A91111; color: white; padding: 1rem; border: none; border-radius: 10px; cursor: pointer; margin-top: 1rem;">Simpan</button>
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
            background-color: white;
            display: flex;
            justify-content: center;
        }
    </style>
@endsection