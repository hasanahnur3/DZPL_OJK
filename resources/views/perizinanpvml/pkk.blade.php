@extends('layouts.app')

@section('content')
    <div class="form-container">
        <div
            style="max-width: 800px; margin: auto; padding: 2rem;  border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color:#ffffff;">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <h2 style="text-align: center; color: #333; margin-bottom:40px; margin-top:-10px;">Tambah Daftar Pengajuan
                Penilaian Kemampuan & Kepatutan</h2>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Seleksi form
                    const form = document.querySelector('form');

                    // Tambahkan event listener ke form
                    form.addEventListener('submit', function (event) {
                        event.preventDefault(); // Mencegah pengiriman form secara default

                        // Tampilkan SweetAlert2
                        Swal.fire({
                            title: 'Data berhasil diupdate!',
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
            <form method="POST" action="{{ route('pkk.store') }}"
                style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                @csrf
                <div style="display: flex; flex-direction: column; gap:5px;">
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

                    <label for="nama_pihak_utama" style="font-weight: bold; color: #555;">Nama Pihak Utama</label>
                    <input type="text" name="nama_pihak_utama" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                    <label for="jabatan" style="font-weight: bold; color: #555;">Jabatan</label>
                    <select name="jabatan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                        <option value="Direktur Utama">Pemegang Saham Pengendali</option>
                        <option value="Direktur Utama">Direktur Utama</option>
                        <option value="Direktur">Direktur / Setara Direktur</option>
                        <option value="Komisaris Utama">Komisaris Utama</option>
                        <option value="Komisaris Utama">Komisaris / Setara Komisaris</option>
                        <option value="Komisaris Utama">Komisaris Independen</option>
                    </select>

                    <label for="status" style="font-weight: bold; color: #555;">Status</label>
                    <select name="status" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                        <option value="Sudah diajukan">Sudah diajukan</option>
                        <option value="Dokumen perlu dilengkapi">Dokumen perlu dilengkapi</option>
                        <option value="Dokumen sudah diverifikasi">Dokumen sudah diverifikasi</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>

                    <label for="nomor_surat_permohonan" style="font-weight: bold; color: #555;">Nomor Surat
                        Permohonan</label>
                    <input type="text" name="nomor_surat_permohonan" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                    <label for="tanggal_surat_permohonan" style="font-weight: bold; color: #555;">Tanggal Surat
                        Permohonan</label>
                    <input type="date" name="tanggal_surat_permohonan" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                    <label for="tanggal_pengajuan_sistem" style="font-weight: bold; color: #555;">Tanggal Pengajuan
                        Sistem</label>
                    <input type="date" name="tanggal_pengajuan_sistem" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                </div>

                <div style="display: flex; flex-direction: column; gap:5px;">
                    <label for="tanggal_dok_lengkap" style="font-weight: bold; color: #555;">Tanggal Dok Lengkap</label>
                    <input type="date" name="tanggal_dok_lengkap"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">


                    <label for="perlu_klarifikasi" style="font-weight: bold; color: #555;">Perlu Klarifikasi</label>
                    <select id="perlu_klarifikasi" name="perlu_klarifikasi" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                        <option value="iya">Iya</option>
                        <option value="tidak">Tidak</option>
                    </select>

                    <label for="tanggal_klarifikasi" id="label_tanggal_klarifikasi"
                        style="font-weight: bold; color: #555;">Tanggal Klarifikasi</label>
                    <input type="date" id="tanggal_klarifikasi" name="tanggal_klarifikasi"
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                    <label for="hasil" style="font-weight: bold; color: #555;">Hasil</label>
                    <select name="hasil" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                        <option value="direkomendasikan">Direkomendasikan</option>
                        <option value="tidak direkomendasikan">Tidak Direkomendasikan</option>
                    </select>


                    <label for="nomor_keputusan" style="font-weight: bold; color: #555;">Nomor Surat Keputusan</label>
                    <input type="text" name="nomor_persetujuan" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                    <label for="tanggal_keputusan" style="font-weight: bold; color: #555;">Tanggal Surat Keputusan</label>
                    <input type="date" name="tanggal_persetujuan" required
                        style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                    <button type="submit"
                        style="background-color: #A91111; color: white; padding: 1rem; border: none; border-radius: 10px; cursor: pointer; margin-top: 1rem;">
                        Simpan
                    </button>

                </div>


            </form>
        </div>
    </div>

    <style>
        .form-container {
            height: auto;
            max-width: 100%;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
            display: flex;
            justify-content: center;
        }
    </style>
    <script>
        const selectElement = document.getElementById('perlu_klarifikasi');
        const dateInput = document.getElementById('tanggal_klarifikasi');
        const labelTanggal = document.getElementById('label_tanggal_klarifikasi');

        selectElement.addEventListener('change', function () {
            if (this.value === 'tidak') {
                dateInput.disabled = true; // Nonaktifkan input
                dateInput.classList.add('hidden'); // Sembunyikan input
                labelTanggal.classList.add('hidden'); // Sembunyikan label
            } else {
                dateInput.disabled = false; // Aktifkan kembali input
                dateInput.classList.remove('hidden'); // Tampilkan kembali input
                labelTanggal.classList.remove('hidden'); // Tampilkan kembali label
            }
        });
    </script>
@endsection