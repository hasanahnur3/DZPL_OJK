@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 90%;
        margin: 0px;
        padding: 0px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 26px;
        font-weight: bold;
        color: #333;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 15px;
        font-size: 16px;
        border-radius: 5px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .table-container {
        overflow-x: auto;
        background: #ffffff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    .table th {
        background-color: #007bff;
        color: white;
        font-size: 14px;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .table tbody tr:hover {
        background-color: #e9ecef;
    }

    .btn-warning, .btn-danger {
        padding: 8px 12px;
        font-size: 14px;
        border-radius: 5px;
        transition: 0.3s;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
    }

    @media screen and (max-width: 768px) {
        .table th, .table td {
            font-size: 12px;
            padding: 8px;
        }

        .btn-warning, .btn-danger {
            padding: 6px 8px;
            font-size: 12px;
        }

        .container {
            max-width: 100%;
            padding: 0px;
        }
    }
</style>

<div class="container">
   
    
    <div class="table-container">
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
                        <td class="action-buttons">
                            <a href="{{ route('quality_control.edit', $control) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('quality_control.destroy', $control) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
