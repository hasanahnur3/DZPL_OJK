@extends('layouts.app')

@section('content')
<div class="form-container">
<div style="max-width: 800px; margin: auto; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<h2 style="text-align: center; color: #333; margin-bottom:10px;">Tambah Daftar Riksus</h2>
    
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
    <form action="{{ route('riksus.store') }}" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        @csrf

        <div style="display: flex; flex-direction: column; gap: 5px;">
        <label for="kode_riskus" style="font-weight: bold; color: #555;">Kode Riskus*</label>
        <input type="text" name="kode_riskus" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
        <div style="display: flex; flex-direction: column; gap: 5px;">
        <label for="jenis_industri" style="font-weight: bold; color: #555;">Jenis Industri</label>
                <select id="jenis_industri" name="jenis_industri" required style="height:35px;">
                    <option value="">Pilih Jenis Industri</option>
                    @foreach($jenis_industri as $jenis)
                        <option value="{{ $jenis }}">{{ $jenis }}</option>
                    @endforeach
                </select>
                
                <label for="jenis_industri" style="font-weight: bold; color: #555;">Nama Perusahaan</label>
                <select id="nama_perusahaan" name="nama_perusahaan" required style="height:35px;">
                    <option value="">Pilih Nama Perusahaan</option>
                </select>
            </div>
            
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
            <input type="text" name="no_nd_pelimpahan" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_nd_pelimpahan" style="font-weight: bold; color: #555;">Tanggal ND Pelimpahan</label>
            <input type="date" name="tanggal_nd_pelimpahan" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="no_rkpk" style="font-weight: bold; color: #555;">No RKPK</label>
            <input type="text" name="no_rkpk" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_rkpk" style="font-weight: bold; color: #555;">Tanggal RKPK</label>
            <input type="date" name="tanggal_rkpk" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="no_surat_tugas" style="font-weight: bold; color: #555;">No Surat Tugas</label>
            <input type="text" name="no_surat_tugas" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_surat_tugas" style="font-weight: bold; color: #555;">Tanggal Surat Tugas</label>
            <input type="date" name="tanggal_surat_tugas" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
            <label for="periode_pemeriksaan_surat_tugas" style="font-weight: bold; color: #555;">Periode Pemeriksaan Surat Tugas</label>
            <input type="text" name="periode_pemeriksaan_surat_tugas" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_qa" style="font-weight: bold; color: #555;">Tanggal QA</label>
            <input type="date" name="tanggal_qa" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_expose" style="font-weight: bold; color: #555;">Tanggal Expose</label>
            <input type="date" name="tanggal_expose" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="paparan_ke_pvml" style="font-weight: bold; color: #555;">Paparan KE ke PVML</label>
            <input type="text" name="paparan_ke_pvml" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

        </div>

        <div style="display: flex; flex-direction: column; gap: 5px;">


            <label for="no_nd_ke_dpjk" style="font-weight: bold; color: #555;">No ND ke DPJK</label>
            <input type="text" name="no_nd_ke_dpjk" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_nd_ke_dpjk" style="font-weight: bold; color: #555;">Tanggal ND ke DPJK</label>
            <input type="date" name="tanggal_nd_ke_dpjk" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="no_bast_ke_dpjk" style="font-weight: bold; color: #555;">No BAST ke DPJK</label>
            <input type="text" name="no_bast_ke_dpjk" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_bast_ke_dpjk" style="font-weight: bold; color: #555;">Tanggal BAST ke DPJK</label>
            <input type="date" name="tanggal_bast_ke_dpjk" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="no_lhpk_ke_dpjk" style="font-weight: bold; color: #555;">No LHPK ke DPJK</label>
            <input type="text" name="no_lhpk_ke_dpjk" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_lhpk_ke_dpjk" style="font-weight: bold; color: #555;">Tanggal LHPK ke DPJK</label>
            <input type="date" name="tanggal_lhpk_ke_dpjk" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
            
            <label for="no_nd_penyampaian_lhpk_ke_pengawas_dpjk" style="font-weight: bold; color: #555;">No ND Penyampaian LHPK ke Pengawas DPJK</label>
            <input type="text" name="no_nd_penyampaian_lhpk_ke_pengawas_dpjk" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk" style="font-weight: bold; color: #555;">Tanggal ND Penyampaian LHPK ke Pengawas DPJK</label>
            <input type="date" name="tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_kpkp" style="font-weight: bold; color: #555;">Tanggal KKPK</label>
            <input type="date" name="tanggal_kpkp" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="no_siputri" style="font-weight: bold; color: #555;">No SIPUTRI</label>
            <input type="text" name="no_siputri" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_siputri" style="font-weight: bold; color: #555;">Tanggal SIPUTRI</label>
            <input type="date" name="tanggal_siputri" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

            <label for="tanggal_persetujuan_kadep" style="font-weight: bold; color: #555;">Tanggal Persetujuan Kadep</label>
            <input type="date" name="tanggal_persetujuan_kadep" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

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
