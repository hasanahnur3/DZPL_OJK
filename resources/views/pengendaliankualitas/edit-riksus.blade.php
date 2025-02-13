@extends('layouts.app')

@section('content')
<div class="form-container">
<div
    style="width: 800px; margin: auto; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <h2 style="text-align: center; color: #333; margin-bottom: 10px;">Edit Daftar Pengendalian Kualitas</h2>

    @if ($errors->any())
        <div style="background-color: #ffcccc; padding: 1rem; border-radius: 5px; margin-bottom: 15px;">
            <ul style="list-style: none; padding: 0; color: #a94442;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Data berhasil diupdate!',
                    text: 'Data Anda telah berhasil dikirim ke server.',
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

    <form action="{{ route('riksus.update', $riksus->id) }}" method="POST"
        style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        @csrf
        @method('PUT')

        <div style="display: flex; flex-direction: column; gap: 5px;">
            <label for="kode_riskus" style="font-weight: bold; color: #555;">Kode Riskus*</label>
<input type="text" name="kode_riskus" class="form-control" required
    style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
    value="{{ old('kode_riskus', $riksus->kode_riskus) }}">

<!-- Dropdown Jenis Industri -->
<select id="jenis_industri" name="jenis_industri" required>
    <option value="">Pilih Jenis Industri</option>
    @foreach($jenis_industri as $jenis)
        <option value="{{ $jenis }}" {{ old('jenis_industri', $riksus->jenis_industri) == $jenis ? 'selected' : '' }}>
            {{ $jenis }}
        </option>
    @endforeach
</select>

<!-- Dropdown Nama Perusahaan -->
<select id="nama_perusahaan" name="nama_perusahaan" required>
    <option value="">Pilih Nama Perusahaan</option>
    @foreach($nama_perusahaan as $perusahaan)
        <option value="{{ $perusahaan }}" {{ old('nama_perusahaan', $riksus->nama_perusahaan) == $perusahaan ? 'selected' : '' }}>
            {{ $perusahaan }}
        </option>
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

            <label for="no_nd_pelimpahan" style="font-weight: bold; color: #555;">No ND Pelimpahan</label>
            <input type="text" name="no_nd_pelimpahan"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('no_nd_pelimpahan', $riksus->no_nd_pelimpahan) }}">

            <label for="tanggal_nd_pelimpahan" style="font-weight: bold; color: #555;">Tanggal ND Pelimpahan</label>
            <input type="date" name="tanggal_nd_pelimpahan"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('tanggal_nd_pelimpahan', $riksus->tanggal_nd_pelimpahan) }}">

            <label for="no_rkpk" style="font-weight: bold; color: #555;">No RKPK</label>
            <input type="text" name="no_rkpk" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('no_rkpk', $riksus->no_rkpk) }}">

            <label for="tanggal_rkpk" style="font-weight: bold; color: #555;">Tanggal RKPK</label>
            <input type="date" name="tanggal_rkpk"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('tanggal_rkpk', $riksus->tanggal_rkpk) }}">

            <label for="no_surat_tugas" style="font-weight: bold; color: #555;">No Surat Tugas</label>
            <input type="text" name="no_surat_tugas"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('no_surat_tugas', $riksus->no_surat_tugas) }}">

            <label for="tanggal_surat_tugas" style="font-weight: bold; color: #555;">Tanggal Surat Tugas</label>
            <input type="date" name="tanggal_surat_tugas"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('tanggal_surat_tugas', $riksus->tanggal_surat_tugas) }}">

            <label for="periode_pemeriksaan_surat_tugas" style="font-weight: bold; color: #555;">Periode Pemeriksaan
                Surat Tugas</label>
            <input type="text" name="periode_pemeriksaan_surat_tugas"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('periode_pemeriksaan_surat_tugas', $riksus->periode_pemeriksaan_surat_tugas) }}">

            <label for="tanggal_qa" style="font-weight: bold; color: #555;">Tanggal QA</label>
            <input type="date" name="tanggal_qa"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('tanggal_qa', $riksus->tanggal_qa) }}">

            <label for="tanggal_expose" style="font-weight: bold; color: #555;">Tanggal Expose </label>
            <input type="date" name="tanggal_expose"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('tanggal_expose', $riksus->tanggal_expose) }}">

            <label for="paparan_ke_pvml" style="font-weight: bold; color: #555;">Paraparan KE ke PVML</label>
            <input type="text" name="paparan_ke_pvml"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('paparan_ke_pvml', $riksus->paparan_ke_pvml) }}">

        </div>

        <div style="display: flex; flex-direction: column; gap: 5px;">


            <label for="no_nd_ke_dpjk" style="font-weight: bold; color: #555;">Nomor ND ke DPJK</label>
            <input type="text" name="no_nd_ke_dpjk"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('no_nd_ke_dpjk', $riksus->no_nd_ke_dpjk) }}">

            <label for="tanggal_nd_ke_dpjk" style="font-weight: bold; color: #555;">Tanggal ND ke DPJK</label>
            <input type="date" name="tanggal_nd_ke_dpjk"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('tanggal_nd_ke_dpjk', $riksus->tanggal_nd_ke_dpjk) }}">

            <label for="no_bast_ke_dpjk" style="font-weight: bold; color: #555;">Nomor BAST ke DPJK</label>
            <input type="text" name="no_bast_ke_dpjk"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('no_bast_ke_dpjk', $riksus->no_bast_ke_dpjk) }}">

            <label for="tanggal_bast_ke_dpjk" style="font-weight: bold; color: #555;">Tanggal BAST ke DPJK</label>
            <input type="date" name="tanggal_bast_ke_dpjk"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('tanggal_bast_ke_dpjk', $riksus->tanggal_bast_ke_dpjk) }}">

            <label for="no_lhpk_ke_dpjk" style="font-weight: bold; color: #555;">Nomor LHPK ke DPJK </label>
            <input type="text" name="no_lhpk_ke_dpjk"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('no_lhpk_ke_dpjk', $riksus->no_lhpk_ke_dpjk) }}">

            <label for="tanggal_lhpk_ke_dpjk" style="font-weight: bold; color: #555;">Tanggal LHPK ke DPJK</label>
            <input type="date" name="tanggal_lhpk_ke_dpjk"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('tanggal_lhpk_ke_dpjk', $riksus->tanggal_lhpk_ke_dpjk) }}">

            <label for="no_nd_penyampaian_lhpk_ke_pengawas_dpjk" style="font-weight: bold; color: #555;">Nomor ND Penyampaian LHPK ke DPJK</label>
            <input type="text" name="no_nd_penyampaian_lhpk_ke_pengawas_dpjk"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('no_nd_penyampaian_lhpk_ke_pengawas_dpjk', $riksus->no_nd_penyampaian_lhpk_ke_pengawas_dpjk) }}">
        
                <label for="tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk" style="font-weight: bold; color: #555;">Tanggal ND Penyampaian LHPK ke DPJK</label>
            <input type="date" name="tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk', $riksus->tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk) }}">


                <label for="tanggal_kpkp" style="font-weight: bold; color: #555;">Tanggal KKPK</label>
            <input type="date" name="tanggal_kpkp"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('tanggal_kpkp', $riksus->tanggal_kpkp) }}">

                <label for="no_siputri" style="font-weight: bold; color: #555;">Nomor SIPUTRI</label>
            <input type="text" name="no_siputri"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('no_siputri', $riksus->no_siputri) }}">

                <label for="tanggal_siputri" style="font-weight: bold; color: #555;">Tanggal SIPUTRI</label>
            <input type="date" name="tanggal_siputri"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('tanggal_siputri', $riksus->tanggal_siputri) }}">

                <label for="tanggal_persetujuan_kadep" style="font-weight: bold; color: #555;">Tanggal Persetujuan Kadep</label>
            <input type="date" name="tanggal_persetujuan_kadep"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('tanggal_persetujuan_kadep', $riksus->tanggal_persetujuan_kadep) }}">
            </div>

        <div style="grid-column: span 2; text-align: center; margin-top: 20px;">
            <button type="submit" class="btn btn-success"
                style="padding: 0.75rem 1.5rem; border-radius: 10px; background-color: #28a745; color: white; font-weight: bold;">Update</button>
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