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
    <div class="form-container">

        <div
            style="width: 800px; margin: auto; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h2>Edit Data Kelembagaan</h2>

            <form action="{{ route('kelembagaan.update', $kelembagaan->id) }}" method="POST"
                style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                @csrf
                @method('PUT')

                <!-- Input Jenis Industri -->
                <div style="display: flex; flex-direction: column; gap:5px;">
                    <label for="jenis_industri" style="font-weight: bold; color: #555;">Jenis Industri</label>
                    <select id="jenis_industri" name="jenis_industri" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                        <option value="">Pilih Jenis Industri</option>
                        @foreach($jenis_industri as $jenis)
                            <option value="{{ $jenis }}" {{ $kelembagaan->jenis_industri == $jenis ? 'selected' : '' }}>
                                {{ $jenis }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Input Nama Perusahaan -->
                <div style="display: flex; flex-direction: column; gap:5px;">
                    <label for="nama_perusahaan" style="font-weight: bold; color: #555;">Nama Perusahaan</label>
                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan"
                        value="{{ $kelembagaan->nama_perusahaan }}" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                </div>

                <!-- Input Detail Izin -->
                <div style="display: flex; flex-direction: column; gap:5px;">
                    <label for="detail_izin" style="font-weight: bold; color: #555;">Detail Izin</label>
                    <select id="detail_izin" name="detail_izin" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                        <option value="">Pilih Detail Izin</option>
                        <!-- Current value will be selected via JavaScript -->
                    </select>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const jenisIndustri = document.getElementById('jenis_industri');
                        const currentDetailIzin = "{{ $kelembagaan->detail_izin }}";

                        // Load detail_izin options when page loads
                        if (jenisIndustri.value) {
                            fetch(`/get-detail-izin?jenis_industri=${jenisIndustri.value}`)
                                .then(response => response.json())
                                .then(data => {
                                    let detailIzinDropdown = document.getElementById('detail_izin');
                                    detailIzinDropdown.innerHTML = '<option value="">Pilih Detail Izin</option>';
                                    data.forEach(detail => {
                                        let option = document.createElement('option');
                                        option.value = detail;
                                        option.textContent = detail;
                                        if (detail === currentDetailIzin) {
                                            option.selected = true;
                                        }
                                        detailIzinDropdown.appendChild(option);
                                    });
                                });
                        }

                        // Update detail_izin when jenis_industri changes
                        jenisIndustri.addEventListener('change', function () {
                            let selectedJenisIndustri = this.value;
                            fetch(`/get-detail-izin?jenis_industri=${selectedJenisIndustri}`)
                                .then(response => response.json())
                                .then(data => {
                                    let detailIzinDropdown = document.getElementById('detail_izin');
                                    detailIzinDropdown.innerHTML = '<option value="">Pilih Detail Izin</option>';
                                    data.forEach(detail => {
                                        let option = document.createElement('option');
                                        option.value = detail;
                                        option.textContent = detail;
                                        detailIzinDropdown.appendChild(option);
                                    });
                                });
                        });
                    });
                </script>

                <!-- Input Status -->
                <div style="display: flex; flex-direction: column; gap:5px;">
                    <label for="status" style="font-weight: bold; color: #555;">Status</label>
                    <select name="status" id="status" class="form-control"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                        <option value="Dalam proses analisis" {{ $kelembagaan->status == 'Dalam proses analisis' ? 'selected' : '' }}>Dalam proses analisis</option>
                        <option value="Kelengkapan dok" {{ $kelembagaan->status == 'Kelengkapan dok' ? 'selected' : '' }}>
                            Kelengkapan dok</option>
                        <option value="Selesai" {{ $kelembagaan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Ditolak/Dikembalikan" {{ $kelembagaan->status == 'Ditolak/Dikembalikan' ? 'selected' : '' }}>Ditolak/Dikembalikan</option>
                    </select>
                </div>

                <!-- Input Nomor Surat Permohonan -->
                <div style="display: flex; flex-direction: column; gap:5px;">
                    <label for="nomor_surat_permohonan" style="font-weight: bold; color: #555;">Nomor Surat
                        Permohonan</label>
                    <input type="text" class="form-control" id="nomor_surat_permohonan" name="nomor_surat_permohonan"
                        value="{{ $kelembagaan->nomor_surat_permohonan }}"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                </div>

                <!-- Input Tanggal Surat Permohonan -->
                <div style="display: flex; flex-direction: column; gap:5px;">
                    <label for="tanggal_surat_permohonan" style="font-weight: bold; color: #555;">Tanggal Surat
                        Permohonan</label>
                    <input type="date" class="form-control" id="tanggal_surat_permohonan" name="tanggal_surat_permohonan"
                        value="{{ $kelembagaan->tanggal_surat_permohonan }}"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                </div>

                <!-- Input Tanggal Pengajuan Sistem -->
                <div style="display: flex; flex-direction: column; gap:5px;">
                    <label for="tanggal_pengajuan_sistem" style="font-weight: bold; color: #555;">Tanggal Pengajuan
                        Sistem</label>
                    <input type="date" class="form-control" id="tanggal_pengajuan_sistem" name="tanggal_pengajuan_sistem"
                        value="{{ $kelembagaan->tanggal_pengajuan_sistem }}"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                </div>

                <!-- Input Tanggal Dokumen Lengkap -->
                <div style="display: flex; flex-direction: column; gap:5px;">
                    <label for="tanggal_dokumen_lengkap" style="font-weight: bold; color: #555;">Tanggal Dokumen
                        Lengkap</label>
                    <input type="date" class="form-control" id="tanggal_dokumen_lengkap" name="tanggal_dokumen_lengkap"
                        value="{{ $kelembagaan->tanggal_dokumen_lengkap }}"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                </div>

                <!-- Input Tanggal Selesai Analisis -->
                <div style="display: flex; flex-direction: column; gap:5px;">
                    <label for="tanggal_selesai_analisis" style="font-weight: bold; color: #555;">Tanggal Selesai
                        Analisis</label>
                    <input type="date" class="form-control" id="tanggal_selesai_analisis" name="tanggal_selesai_analisis"
                        value="{{ $kelembagaan->tanggal_selesai_analisis }}"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                </div>

                <!-- Input Nomor Surat -->
                <div style="display: flex; flex-direction: column; gap:5px;">
                    <label for="nomor_surat" style="font-weight: bold; color: #555;">Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat"
                        value="{{ $kelembagaan->nomor_surat }}"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                </div>

                <!-- Input Tanggal Surat -->
                <div style="display: flex; flex-direction: column; gap:5px;">
                    <label for="tanggal_surat" style="font-weight: bold; color: #555;">Tanggal Surat</label>
                    <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat"
                        value="{{ $kelembagaan->tanggal_surat }}"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                </div>

                <!-- Input Aksi -->
                <div style="display: flex; flex-direction: column; gap:5px;"> <!-- Update Button -->
                    <button type="submit"
                        style="background-color: #A91111; color: white; padding: 1rem; border: none; border-radius: 10px; cursor: pointer; margin-top: 1rem; align-item:end;">Update</button>

                </div>

            </form>
        </div>
    </div>
    <style>
        .form-container {
            height: auto;
            max-width: 100%;
            padding: 2rem;
            background-color: white;
            display: flex;
            justify-content: center;
        }
    </style>
@endsection