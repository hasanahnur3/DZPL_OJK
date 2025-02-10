@extends('layouts.app')

@section('content')
<div class="form-container">
<div
    style="width: 800px; margin: auto; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <h2 style="text-align: center; color: #333; margin-bottom: 10px;">Edit Data Quality Control</h2>

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

    <form action="{{ route('quality_control.update', $qualityControl) }}" method="POST"
        style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        @csrf
        @method('PUT')

        <div style="display: flex; flex-direction: column; gap: 5px;">
            <label for="industry_type" style="font-weight: bold; color: #555;">Jenis Industri</label>
            <input type="text" id="industry_type" name="industry_type" class="form-control" required
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('industry_type', $qualityControl->industry_type) }}">

            <label for="criteria" style="font-weight: bold; color: #555;">Kriteria</label>
            <textarea id="criteria" name="criteria" rows="3" class="form-control" required
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">{{ old('criteria', $qualityControl->criteria) }}</textarea>

            <label for="company_name" style="font-weight: bold; color: #555;">Nama Perusahaan</label>
            <input type="text" id="company_name" name="company_name" class="form-control" required
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('company_name', $qualityControl->company_name) }}">

            <label for="forum_date" style="font-weight: bold; color: #555;">Tanggal Forum</label>
            <input type="date" id="forum_date" name="forum_date" class="form-control"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('forum_date', $qualityControl->forum_date) }}">

            <label for="financial_issues" style="font-weight: bold; color: #555;">Masalah Keuangan</label>
            <textarea id="financial_issues" name="financial_issues" rows="3" class="form-control"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">{{ old('financial_issues', $qualityControl->financial_issues) }}</textarea>

            <label for="non_financial_issues" style="font-weight: bold; color: #555;">Masalah Non Keuangan</label>
            <textarea id="non_financial_issues" name="non_financial_issues" rows="3" class="form-control"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">{{ old('non_financial_issues', $qualityControl->non_financial_issues) }}</textarea>

            <label for="root_cause" style="font-weight: bold; color: #555;">Akar Penyebab</label>
            <textarea id="root_cause" name="root_cause" rows="3" class="form-control"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">{{ old('root_cause', $qualityControl->root_cause) }}</textarea>

            <label for="main_recommendation" style="font-weight: bold; color: #555;">Rekomendasi Utama</label>
            <textarea id="main_recommendation" name="main_recommendation" rows="3" class="form-control"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">{{ old('main_recommendation', $qualityControl->main_recommendation) }}</textarea>


        </div>

        <div style="display: flex; flex-direction: column; gap: 5px;">

            <label for="supporting_recommendation" style="font-weight: bold; color: #555;">Rekomendasi Pendukung</label>
            <textarea id="supporting_recommendation" name="supporting_recommendation" rows="3" class="form-control"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">{{ old('supporting_recommendation', $qualityControl->supporting_recommendation) }}</textarea>

            <label for="panelists" style="font-weight: bold; color: #555;">Panelis</label>
            <textarea id="panelists" name="panelists" rows="3" class="form-control"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">{{ old('panelists', $qualityControl->panelists) }}</textarea>

            <label for="supervisors" style="font-weight: bold; color: #555;">Pengawas</label>
            <textarea id="supervisors" name="supervisors" rows="3" class="form-control"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">{{ old('supervisors', $qualityControl->supervisors) }}</textarea>

            <label for="document_submission_date" style="font-weight: bold; color: #555;">Tanggal Pengajuan
                Dokumen</label>
            <input type="date" id="document_submission_date" name="document_submission_date" class="form-control"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('document_submission_date', $qualityControl->document_submission_date) }}">

            <label for="working_days" style="font-weight: bold; color: #555;">Hari Kerja</label>
            <input type="number" id="working_days" name="working_days" class="form-control"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('working_days', $qualityControl->working_days) }}">

            <label for="document_number" style="font-weight: bold; color: #555;">Nomor Dokumen</label>
            <input type="text" id="document_number" name="document_number" class="form-control"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('document_number', $qualityControl->document_number) }}">

            <label for="follow_up_submission_date" style="font-weight: bold; color: #555;">Tanggal Pengajuan Tindak
                Lanjut</label>
            <input type="date" id="follow_up_submission_date" name="follow_up_submission_date" class="form-control"
                style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;"
                value="{{ old('follow_up_submission_date', $qualityControl->follow_up_submission_date) }}">

            <label for="follow_up_status" style="font-weight: bold; color: #555;">Status Tindak Lanjut</label>
            <select name="follow_up_status" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 10px;">
                <option value="">Sudah Lengkap</option>
                <option value="Sudah Lengkap" {{ old('follow_up_status', $qualityControl->follow_up_status) == 'Manufaktur' ? 'selected' : '' }}>Sudah Lengkap</option>
                <option value="Belum Lengkap" {{ old('follow_up_status', $qualityControl->follow_up_status) == 'Jasa' ? 'selected' : '' }}>Belum Lengkap
                </option>
            </select>
        </div>
        <div style="grid-column: span 2; text-align: center; margin-top: 20px;">
            <button type="submit" class="btn btn-success"
                style="padding: 0.75rem 1.5rem; border-radius: 10px; background-color: #28a745; color: white; font-weight: bold;">Update</button>
        </div>
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