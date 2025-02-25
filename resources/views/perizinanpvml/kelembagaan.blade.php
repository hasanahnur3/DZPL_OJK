@extends('layouts.app')

@section('content')
    <div class="form-container">
        <div
            style="width: 900px; margin: auto; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color:#FFFFFF">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <h2 style="text-align: center; color: #333; margin-top:-10px;">Tambah Data Kelembagaan</h2>

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

            <form action="{{ route('kelembagaan.store') }}" method="POST"
                style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                @csrf
                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <select id="jenis_industri" name="jenis_industri" required style="height: 40px; gap:10px">
                        <option value="">Pilih Jenis Industri</option>
                        @foreach($jenis_industri as $jenis)
                            <option value="{{ $jenis }}">{{ $jenis }}</option>
                        @endforeach
                    </select>

                    <select id="nama_perusahaan" name="nama_perusahaan" required style="height:40px ">
                        <option value="">Pilih Nama Perusahaan</option>
                    </select>
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
                    <label for="detail_izin" style="font-weight: bold; color: #555;">Detail Izin</label>
                    <select id="detail_izin" name="detail_izin" required style="height: 40px; gap:10px">
                        <option value="">Pilih Detail Izin</option>
                        @foreach($detail_izin as $izin)
                            <option value="{{ $izin }}">{{ $izin }}</option>
                        @endforeach
                    </select>

                    <label for="status" style="font-weight: bold; color: #555;">Status</label>
                    <select name="status" id="status" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px; width: 100%;">
                        <option value="">Pilih Status</option>
                        <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Ditolak/Dikembalikan" {{ old('status') == 'Ditolak/Dikembalikan' ? 'selected' : '' }}>Ditolak/Dikembalikan</option>
                        <option value="Kelengkapan dok" {{ old('status') == 'Kelengkapan dok' ? 'selected' : '' }}>Kelengkapan dok</option>
                        <option value="Dalam proses analisis" {{ old('status') == 'Dalam proses analisis' ? 'selected' : '' }}>Dalam proses analisis</option>
                    </select>


                    <label for="nomor_surat_permohonan" style="font-weight: bold; color: #555;">Nomor Surat
                        Permohonan</label>
                    <input type="text" name="nomor_surat_permohonan" id="nomor_surat_permohonan"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                        value="{{ old('nomor_surat_permohonan') }}">

                    <label for="tanggal_surat_permohonan" style="font-weight: bold; color: #555;">Tanggal Surat
                        Permohonan</label>
                    <input type="date" name="tanggal_surat_permohonan" id="tanggal_surat_permohonan" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                        value="{{ old('tanggal_surat_permohonan') }}">

                    <label for="tanggal_pengajuan_sistem" style="font-weight: bold; color: #555;">Tanggal Pengajuan
                        Sistem</label>
                    <input type="date" name="tanggal_pengajuan_sistem" id="tanggal_pengajuan_sistem"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                        value="{{ old('tanggal_pengajuan_sistem') }}">
                </div>

                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label for="tanggal_dokumen_lengkap" style="font-weight: bold; color: #555;">Tanggal Dokumen
                        Lengkap</label>
                    <input type="date" name="tanggal_dokumen_lengkap" id="tanggal_dokumen_lengkap"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                        value="{{ old('tanggal_dokumen_lengkap') }}">

                    <label for="tanggal_selesai_analisis" style="font-weight: bold; color: #555;">Tanggal Selesai
                        Analisis</label>
                    <input type="date" name="tanggal_selesai_analisis" id="tanggal_selesai_analisis"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                        value="{{ old('tanggal_selesai_analisis') }}">

                    <label for="sla" style="font-weight: bold; color: #555;">SLA</label>
                    <input type="number" name="sla" id="sla"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;" value="{{ old('sla') }}">

                    <label for="nomor_surat" style="font-weight: bold; color: #555;">Nomor Surat</label>
                    <input type="text" name="nomor_surat" id="nomor_surat"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                        value="{{ old('nomor_surat') }}">

                    <label for="tanggal_surat" style="font-weight: bold; color: #555;">Tanggal Surat</label>
                    <input type="date" name="tanggal_surat" id="tanggal_surat"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                        value="{{ old('tanggal_surat') }}">

                    <label for="jumlah_hari_kerja" style="font-weight: bold; color: #555;">Jumlah Hari Kerja</label>
                    <input type="text" name="jumlah_hari_kerja" id="jumlah_hari_kerja"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                        value="{{ old('jumlah_hari_kerja') }}">
                    <button type="submit"
                        style="background-color: #A91111; color: white; padding: 1rem; border: none; border-radius: 10px; cursor: pointer; margin-top: 1rem;">Simpan</button>

                </div>
            </form>
        </div>
    </div>

    <style>
        .form-container {
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
