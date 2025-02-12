@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pengendalian Kualitas</h1>

    <form action="{{ route('quality_control.store') }}" method="POST">
        @csrf
        <div style="display: flex; flex-direction: column; gap: 5px;">
            <label for="jenis_industri">Jenis Industri</label>
            <select id="jenis_industri" name="jenis_industri" required>
                <option value="">Pilih Jenis Industri</option>
                @foreach($jenis_industri as $jenis)
                    <option value="{{ $jenis }}">{{ $jenis }}</option>
                @endforeach
            </select>
            
            <label for="nama_perusahaan">Nama Perusahaan</label>
            <select id="nama_perusahaan" name="nama_perusahaan" required>
                <option value="">Pilih Nama Perusahaan</option>
            </select>
        </div>

        <script>
            document.getElementById('jenis_industri').addEventListener('change', function() {
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

        <div class="form-group">
            <label for="criteria">Kriteria</label>
            <textarea class="form-control" id="criteria" name="criteria" required></textarea>
            @error('criteria')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

      <!--  <div class="form-group">
            <label for="pvml_utama">PVML Utama</label>
            <input type="text" class="form-control" id="pvml_utama" name="pvml_utama" required>
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

        <div class="form-group">
            <label for="forum_date">Tanggal Forum</label>
            <input type="date" class="form-control" id="forum_date" name="forum_date" required>
            @error('forum_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="financial_issues">Masalah Keuangan</label>
            <textarea class="form-control" id="financial_issues" name="financial_issues" required></textarea>
            @error('financial_issues')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="non_financial_issues">Masalah Non-Keuangan</label>
            <textarea class="form-control" id="non_financial_issues" name="non_financial_issues" required></textarea>
            @error('non_financial_issues')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="root_cause">Penyebab Utama</label>
            <textarea class="form-control" id="root_cause" name="root_cause" required></textarea>
            @error('root_cause')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="main_recommendation">Rekomendasi Utama</label>
            <textarea class="form-control" id="main_recommendation" name="main_recommendation" required></textarea>
            @error('main_recommendation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="supporting_recommendation">Rekomendasi Pendukung</label>
            <textarea class="form-control" id="supporting_recommendation" name="supporting_recommendation" required></textarea>
            @error('supporting_recommendation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="follow_up_deadline">Batas Waktu Tindak Lanjut</label>
            <input type="date" class="form-control" id="follow_up_deadline" name="follow_up_deadline" required>
            @error('follow_up_deadline')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="panelists">Panelis (5 Orang)</label>
            <input type="text" class="form-control" id="panelists" name="panelists" placeholder="Nama Panelis, pisahkan dengan koma" required>
            @error('panelists')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="supervisors">Pengawas (6 Orang)</label>
            <input type="text" class="form-control" id="supervisors" name="supervisors" placeholder="Nama Pengawas, pisahkan dengan koma" required>
            @error('supervisors')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="document_submission_date">Tanggal Pengajuan Dokumen</label>
            <input type="date" class="form-control" id="document_submission_date" name="document_submission_date" required>
            @error('document_submission_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="working_days">Hari Kerja</label>
            <input type="number" class="form-control" id="working_days" name="working_days" required>
            @error('working_days')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="document_number">Nomor Dokumen</label>
            <input type="text" class="form-control" id="document_number" name="document_number" required>
            @error('document_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="follow_up_submission_date">Tanggal Pengajuan Tindak Lanjut</label>
            <input type="date" class="form-control" id="follow_up_submission_date" name="follow_up_submission_date" required>
            @error('follow_up_submission_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="follow_up_status">Status Tindak Lanjut</label>
            <select class="form-control" id="follow_up_status" name="follow_up_status" required>
                <option value="Sudah Lengkap">Sudah Lengkap</option>
                <option value="Belum Lengkap">Belum Lengkap</option>
            </select>
            @error('follow_up_status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            
            <textarea class="form-control mt-2" id="follow_up_status_description" 
                      name="follow_up_status_description" 
                      placeholder="Jika 'Belum Lengkap', beri keterangan" 
                      rows="3"></textarea>
            @error('follow_up_status_description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
