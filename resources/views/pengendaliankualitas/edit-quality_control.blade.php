@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Data Quality Control</h1>

    <form action="{{ route('quality_control.update', $qualityControl) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="industry_type">Jenis Industri</label>
            <input type="text" class="form-control" id="industry_type" name="industry_type" value="{{ old('industry_type', $qualityControl->industry_type) }}" required>
        </div>

        <div class="form-group">
            <label for="criteria">Kriteria</label>
            <textarea class="form-control" id="criteria" name="criteria" rows="3" required>{{ old('criteria', $qualityControl->criteria) }}</textarea>
        </div>

        <div class="form-group">
            <label for="company_name">Nama Perusahaan</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $qualityControl->company_name) }}" required>
        </div>

        <div class="form-group">
            <label for="forum_date">Tanggal Forum</label>
            <input type="date" class="form-control" id="forum_date" name="forum_date" value="{{ old('forum_date', $qualityControl->forum_date) }}">
        </div>

        <div class="form-group">
            <label for="financial_issues">Masalah Keuangan</label>
            <textarea class="form-control" id="financial_issues" name="financial_issues" rows="3">{{ old('financial_issues', $qualityControl->financial_issues) }}</textarea>
        </div>

        <div class="form-group">
            <label for="non_financial_issues">Masalah Non Keuangan</label>
            <textarea class="form-control" id="non_financial_issues" name="non_financial_issues" rows="3">{{ old('non_financial_issues', $qualityControl->non_financial_issues) }}</textarea>
        </div>

        <div class="form-group">
            <label for="root_cause">Akar Penyebab</label>
            <textarea class="form-control" id="root_cause" name="root_cause" rows="3">{{ old('root_cause', $qualityControl->root_cause) }}</textarea>
        </div>

        <div class="form-group">
            <label for="main_recommendation">Rekomendasi Utama</label>
            <textarea class="form-control" id="main_recommendation" name="main_recommendation" rows="3">{{ old('main_recommendation', $qualityControl->main_recommendation) }}</textarea>
        </div>

        <div class="form-group">
            <label for="supporting_recommendation">Rekomendasi Pendukung</label>
            <textarea class="form-control" id="supporting_recommendation" name="supporting_recommendation" rows="3">{{ old('supporting_recommendation', $qualityControl->supporting_recommendation) }}</textarea>
        </div>

        <div class="form-group">
            <label for="follow_up_deadline">Tanggal Batas Tindak Lanjut</label>
            <input type="date" class="form-control" id="follow_up_deadline" name="follow_up_deadline" value="{{ old('follow_up_deadline', $qualityControl->follow_up_deadline) }}">
        </div>

        <div class="form-group">
            <label for="panelists">Panelis</label>
            <textarea class="form-control" id="panelists" name="panelists" rows="3">{{ old('panelists', $qualityControl->panelists) }}</textarea>
        </div>

        <div class="form-group">
            <label for="supervisors">Pengawas</label>
            <textarea class="form-control" id="supervisors" name="supervisors" rows="3">{{ old('supervisors', $qualityControl->supervisors) }}</textarea>
        </div>

        <div class="form-group">
            <label for="document_submission_date">Tanggal Pengajuan Dokumen</label>
            <input type="date" class="form-control" id="document_submission_date" name="document_submission_date" value="{{ old('document_submission_date', $qualityControl->document_submission_date) }}">
        </div>

        <div class="form-group">
            <label for="working_days">Hari Kerja</label>
            <input type="number" class="form-control" id="working_days" name="working_days" value="{{ old('working_days', $qualityControl->working_days) }}">
        </div>

        <div class="form-group">
            <label for="document_number">Nomor Dokumen</label>
            <input type="text" class="form-control" id="document_number" name="document_number" value="{{ old('document_number', $qualityControl->document_number) }}">
        </div>

        <div class="form-group">
            <label for="follow_up_submission_date">Tanggal Pengajuan Tindak Lanjut</label>
            <input type="date" class="form-control" id="follow_up_submission_date" name="follow_up_submission_date" value="{{ old('follow_up_submission_date', $qualityControl->follow_up_submission_date) }}">
        </div>

        <div class="form-group">
            <label for="follow_up_status">Status Tindak Lanjut</label>
            <select class="form-control" id="follow_up_status" name="follow_up_status">
                <option value="Belum Lengkap" {{ $qualityControl->follow_up_status == 'Belum Lengkap' ? 'selected' : '' }}>Belum Lengkap</option>
                <option value="Sudah Lengkap" {{ $qualityControl->follow_up_status == 'Sudah Lengkap' ? 'selected' : '' }}>Sudah Lengkap</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
