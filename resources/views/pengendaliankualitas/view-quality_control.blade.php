@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Quality Control Management</h1>

    <a href="{{ route('quality_control.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Jenis Industri</th>
                <th>Kriteria</th>
                <th>Nama Perusahaan</th>
                <th>Tanggal Forum</th>
                <th>Masalah Keuangan</th>
                <th>Masalah Non Keuangan</th>
                <th>Akar Penyebab</th>
                <th>Rekomendasi Utama</th>
                <th>Rekomendasi Pendukung</th>
                <th>Tanggal Batas Tindak Lanjut</th>
                <th>Panelis</th>
                <th>Pengawas</th>
                <th>Tanggal Pengajuan Dokumen</th>
                <th>Hari Kerja</th>
                <th>Nomor Dokumen</th>
                <th>Tanggal Pengajuan Tindak Lanjut</th>
                <th>Status Tindak Lanjut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($qualityControls as $control)
                <tr>
                    <td>{{ $control->id }}</td>
                    <td>{{ $control->industry_type }}</td>
                    <td>{{ $control->criteria }}</td>
                    <td>{{ $control->company_name }}</td>
                    <td>{{ $control->forum_date }}</td>
                    <td>{{ $control->financial_issues }}</td>
                    <td>{{ $control->non_financial_issues }}</td>
                    <td>{{ $control->root_cause }}</td>
                    <td>{{ $control->main_recommendation }}</td>
                    <td>{{ $control->supporting_recommendation }}</td>
                    <td>{{ $control->follow_up_deadline }}</td>
                    <td>{{ $control->panelists }}</td>
                    <td>{{ $control->supervisors }}</td>
                    <td>{{ $control->document_submission_date }}</td>
                    <td>{{ $control->working_days }}</td>
                    <td>{{ $control->document_number }}</td>
                    <td>{{ $control->follow_up_submission_date }}</td>
                    <td>{{ $control->follow_up_status }}</td>
                    <td>
                        <a href="{{ route('quality_control.edit', $control) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('quality_control.destroy', $control) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
