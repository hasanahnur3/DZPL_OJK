@extends('layouts.app')

@section('content')
<div class="form-container">
    <div style="width: 800px; margin: auto; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <h2 style="text-align: center; color: #333; margin-bottom: 10px;">Tambah Daftar Pengendalian Kualitas</h2>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.querySelector('form');
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Data berhasil disimpan!',
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

        <form action="{{ route('quality_control.store') }}" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            @csrf
            <div style="display: flex; flex-direction: column; gap: 5px;">
                <label for="industry_type" style="font-weight: bold; color: #555;">Jenis Industri</label>
                <select name="industry_type" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                    <option value="">Pilih Jenis Industri</option>
                    <option value="Perusahaan Pembiayaan">Perusahaan Pembiayaan</option>
                    <option value="Perusahaan Modal Ventura">Perusahaan Modal Ventura</option>
                    <option value="LPBBTI">LPBBTI</option>
                    <option value="Lembaga Keuangan Mikro">Lembaga Keuangan Mikro</option>
                    <option value="Pergadaian">Pergadaian</option>
                    <option value="Sui Generis">Sui Generis</option>
                </select>

                <label for="criteria" style="font-weight: bold; color: #555;">Kriteria</label>
                <textarea name="criteria" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>

                <label for="pvml_utama" style="font-weight: bold; color: #555;">PVML Utama</label>
                <input type="text" name="pvml_utama" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                <label for="special_monitoring_status" style="font-weight: bold; color: #555;">Status Pengawasan Khusus</label>
                <input type="text" name="special_monitoring_status" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                <label for="intensive_monitoring_status" style="font-weight: bold; color: #555;">Status Pengawasan Intensif</label>
                <input type="text" name="intensive_monitoring_status" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                <label for="other_considerations" style="font-weight: bold; color: #555;">Pertimbangan Lainnya</label>
                <textarea name="other_considerations" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>

                <label for="company_name" style="font-weight: bold; color: #555;">Nama Perusahaan</label>
                <input type="text" name="company_name" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
            
                <label for="forum_date" style="font-weight: bold; color: #555;">Tanggal Forum</label>
                <input type="date" name="forum_date" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">


            </div>

            <div style="display: flex; flex-direction: column; gap: 5px;">
            <label for="financial_issues" style="font-weight: bold; color: #555;">Masalah Keuangan</label>
                <textarea name="financial_issues" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>

                <label for="non_financial_issues" style="font-weight: bold; color: #555;">Masalah Non-Keuangan</label>
                <textarea name="non_financial_issues" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>

                <label for="root_cause" style="font-weight: bold; color: #555;">Penyebab Utama</label>
                <textarea name="root_cause" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>

                <label for="main_recommendation" style="font-weight: bold; color: #555;">Rekomendasi Utama</label>
                <textarea name="main_recommendation" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>

                <label for="supporting_recommendation" style="font-weight: bold; color: #555;">Rekomendasi Pendukung</label>
                <textarea name="supporting_recommendation" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>

                <label for="follow_up_deadline" style="font-weight: bold; color: #555;">Batas Waktu Tindak Lanjut</label>
                <input type="date" name="follow_up_deadline" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">

                <label for="follow_up_status" style="font-weight: bold; color: #555;">Status Tindak Lanjut</label>
                <select name="follow_up_status" class="form-control" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                    <option value="Sudah Lengkap">Sudah Lengkap</option>
                    <option value="Belum Lengkap">Belum Lengkap</option>
                </select>
                <textarea name="follow_up_status_description" class="form-control mt-2" placeholder="Jika 'Belum Lengkap', beri keterangan" rows="3" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>
            </div>

            <button type="submit" style="background-color: #A91111; color: white; padding: 1rem; border: none; border-radius: 10px; cursor: pointer; grid-column: span 2; margin-top: 1rem;">Simpan</button>
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
