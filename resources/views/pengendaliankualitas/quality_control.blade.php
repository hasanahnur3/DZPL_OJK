@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-container">
    <div style="width: 800px; margin: auto; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

        <h1 style="text-align: center; color: #333; margin-bottom: 10px;">Pengendalian Kualitas</h1>

        <form action="{{ route('quality_control.store') }}" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            @csrf
            <div style="display: flex; flex-direction: column; gap: 5px;">
                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label for="jenis_industri" style="font-weight: bold; color: #555;">Jenis Industri</label>
                    <select id="jenis_industri" name="jenis_industri" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                        <option value="">Pilih Jenis Industri</option>
                        @foreach($jenis_industri as $jenis)
                            <option value="{{ $jenis }}">{{ $jenis }}</option>
                        @endforeach
                    </select>

                    <label for="nama_perusahaan" style="font-weight: bold; color: #555;">Nama Perusahaan</label>
                    <select id="nama_perusahaan" name="nama_perusahaan" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                        <option value="">Pilih Nama Perusahaan</option>
                    </select>
                </div>

                <script>
                    document.getElementById('jenis_industri').addEventListener('change', function () {
                        let jenisIndustri = this.value;

                        if (jenisIndustri) {
                            fetch(`{{ route('get.companies') }}?jenis_industri=${encodeURIComponent(jenisIndustri)}`)
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error(`HTTP error! status: ${response.status}`);
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    let namaPerusahaanDropdown = document.getElementById('nama_perusahaan');
                                    namaPerusahaanDropdown.innerHTML = '<option value="">Pilih Nama Perusahaan</option>';

                                    if (data && Array.isArray(data)) {
                                        data.forEach(nama => {
                                            let option = document.createElement('option');
                                            option.value = nama;
                                            option.textContent = nama;
                                            namaPerusahaanDropdown.appendChild(option);
                                        });
                                    } else {
                                        console.error("Invalid data received:", data);
                                        namaPerusahaanDropdown.innerHTML = '<option value="">Tidak ada perusahaan ditemukan</option>';
                                    }
                                })
                                .catch(error => {
                                    console.error("Error fetching companies:", error);
                                    alert("Terjadi kesalahan saat mengambil data perusahaan.");
                                });
                        } else {
                            let namaPerusahaanDropdown = document.getElementById('nama_perusahaan');
                            namaPerusahaanDropdown.innerHTML = '<option value="">Pilih Nama Perusahaan</option>';
                        }
                    });
                </script>

                    <label for="criteria" style="font-weight: bold; color: #555;">Kriteria</label>
                    <textarea class="form-control" id="criteria" name="criteria" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>
                    @error('criteria')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                

                    <label for="forum_date" style="font-weight: bold; color: #555;">Tanggal Forum</label>
                    <input type="date" class="form-control" id="forum_date" name="forum_date" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                    @error('forum_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                

                    <label for="financial_issues" style="font-weight: bold; color: #555;">Masalah Keuangan</label>
                    <textarea class="form-control" id="financial_issues" name="financial_issues" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>
                    @error('financial_issues')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                

                    <label for="non_financial_issues" style="font-weight: bold; color: #555;">Masalah Non-Keuangan</label>
                    <textarea class="form-control" id="non_financial_issues" name="non_financial_issues"
                        required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>
                    @error('non_financial_issues')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                

                    <label for="root_cause" style="font-weight: bold; color: #555;">Penyebab Utama</label>
                    <textarea class="form-control" id="root_cause" name="root_cause" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>
                    @error('root_cause')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                

                    <label for="main_recommendation" style="font-weight: bold; color: #555;">Rekomendasi Utama</label>
                    <textarea class="form-control" id="main_recommendation" name="main_recommendation" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>
                    @error('main_recommendation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="supporting_recommendation" style="font-weight: bold; color: #555;">Rekomendasi Pendukung</label>
                    <textarea class="form-control" id="supporting_recommendation" name="supporting_recommendation"
                        required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"></textarea>
                    @error('supporting_recommendation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                
            </div>

            <div style="display: flex; flex-direction: column; gap: 5px;">

                    <label for="follow_up_deadline" style="font-weight: bold; color: #555;">Batas Waktu Tindak Lanjut</label>
                    <input type="date" class="form-control" id="follow_up_deadline" name="follow_up_deadline" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                    @error('follow_up_deadline')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                

                    <label for="panelists" style="font-weight: bold; color: #555;">Panelis (5 Orang)</label>
                    <input type="text" class="form-control" id="panelists" name="panelists"
                        placeholder="Nama Panelis, pisahkan dengan koma" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                    @error('panelists')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                

                    <label for="supervisors" style="font-weight: bold; color: #555;">Pengawas (6 Orang)</label>
                    <input type="text" class="form-control" id="supervisors" name="supervisors"
                        placeholder="Nama Pengawas, pisahkan dengan koma" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                    @error('supervisors')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                

                    <label for="document_submission_date" style="font-weight: bold; color: #555;">Tanggal Pengajuan Dokumen</label>
                    <input type="date" class="form-control" id="document_submission_date" name="document_submission_date"
                        required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                    @error('document_submission_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                

                    <label for="working_days" style="font-weight: bold; color: #555;">Hari Kerja</label>
                    <input type="number" class="form-control" id="working_days" name="working_days" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                    @error('working_days')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                

                    <label for="document_number"style="font-weight: bold; color: #555;">Nomor Dokumen</label>
                    <input type="text" class="form-control" id="document_number" name="document_number" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                    @error('document_number')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                

                    <label for="follow_up_submission_date" style="font-weight: bold; color: #555;">Tanggal Pengajuan Tindak Lanjut</label>
                    <input type="date" class="form-control" id="follow_up_submission_date" name="follow_up_submission_date"
                        required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                    @error('follow_up_submission_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                

                    <label for="follow_up_status" style="font-weight: bold; color: #555;">Status Tindak Lanjut</label>
                    <select class="form-control" id="follow_up_status" name="follow_up_status" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                        <option value="Sudah Lengkap">Sudah Lengkap</option>
                        <option value="Belum Lengkap">Belum Lengkap</option>
                    </select>
                    @error('follow_up_status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <textarea class="form-control mt-2" id="follow_up_status_description"
                        name="follow_up_status_description" placeholder="Jika 'Belum Lengkap', beri keterangan"
                        rows="3"></textarea>
                    @error('follow_up_status_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
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



<!--  <div class="form-group">
            <label for="pvml_utama">PVML Utama</label>
            <input type="text" class="form-control" id="pvml_utama" name="pvml_utama" required style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
            @error('pvml_utama')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="special_monitoring_status">Status Pengawasan Khusus</label>
            <input type="text" class="form-control" id="special_monitoring_status" name="special_monitoring_status" required>
            @error('special_monitoring_status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="intensive_monitoring_status">Status Pengawasan Intensif</label>
            <input type="text" class="form-control" id="intensive_monitoring_status" name="intensive_monitoring_status" required>
            @error('intensive_monitoring_status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="other_considerations">Pertimbangan Lainnya</label>
            <textarea class="form-control" id="other_considerations" name="other_considerations" required></textarea>
            @error('other_considerations')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>-->