@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="form-container" style="overflow-x: auto;">
    <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Daftar Kelembagaan PVML</h2>

    <table id="kelembagaanTable" class="table" style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
        <thead style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
            <tr>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">No</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jenis Industri</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nama Perusahaan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Detail Izin</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">SLA</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Status</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nomor Surat Permohonan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Surat Permohonan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Pengajuan Sistem</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Dokumen Lengkap</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Selesai Analisis</th>                
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nomor Surat</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Surat</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; ">Created At</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; ">Updated At</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kelembagaan as $index => $item)
            <tr>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $index + 1 }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->jenis_industri }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->nama_perusahaan }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->detail_izin ?? '-' }}</td>
<!-- In view-kelembagaan.blade.php -->
<!-- Replace just the SLA column in the table -->
<td style="padding: 0.75rem; border: 1px solid #dee2e6;">
    @if(strtolower($item->status) == 'selesai')
        -
    @elseif($item->tanggal_dokumen_lengkap)
        @if(is_numeric($item->sla_remaining))
            <span style="color: {{ $item->sla_remaining < 0 ? 'red' : 'green' }}">
                {{ $item->sla_remaining }}
            </span>
        @else
            {{ $item->sla_remaining }}
        @endif
    @else
        -
    @endif
</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->status }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->nomor_surat_permohonan ?? '-' }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6;">
                    {{ $item->tanggal_surat_permohonan ? date('d-m-Y', strtotime($item->tanggal_surat_permohonan)) : '-' }}
                </td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6;">
                    {{ $item->tanggal_pengajuan_sistem ? date('d-m-Y', strtotime($item->tanggal_pengajuan_sistem)) : '-' }}
                </td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6;">
                    {{ $item->tanggal_dokumen_lengkap ? date('d-m-Y', strtotime($item->tanggal_dokumen_lengkap)) : '-' }}
                </td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6;">
                    {{ $item->tanggal_selesai_analisis ? date('d-m-Y', strtotime($item->tanggal_selesai_analisis)) : '-' }}
                </td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->nomor_surat ?? '-' }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6;">
                    {{ $item->tanggal_surat ? date('d-m-Y', strtotime($item->tanggal_surat)) : '-' }}
                </td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                                    {{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}
                                </td>
                                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                                    {{ $item->updated_at ? $item->updated_at->format('d-m-Y H:i') : '-' }}
                                </td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                    @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
                        <a href="{{ route('kelembagaan.edit', $item->id) }}"
                        style="background-color: #007bff; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;">Edit</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="text-align: right; margin-bottom: 1rem;" class="button-container">
        @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
            <a href="{{ route('kelembagaan.create') }}" style="background-color: #28a745; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;"
            class="btn btn-success">Tambah Data</a>
        @endif
    </div>
</div>

<script>
$(document).ready(function () {
    $('#kelembagaanTable').DataTable({         
        scrollX: true,
        "pageLength": 6 // Enables horizontal scrolling
    });
});
</script>

<style>
    .form-container {
        max-width: 100%;
        width: 100%;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: white;
    }

    .button-container {
        margin-top: 20px;
    }

    .btn-success {
        background-color: #28a745;
        border: 2px solid #28a745;
        border-radius: 8px;
        padding: 10px 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: white;
        text-align: center;
        text-decoration: none;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn {
        display: inline-block;
        padding: 8px 16px;
        background-color: #ffc107;
        color: black;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: bold;
    }

    .btn:hover {
        background-color: #e0a800;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        height:43px;
    }

    .table th, .table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        overflow: hidden; /* Prevent text from overflowing */
        text-overflow: ellipsis; /* Add ellipsis (...) for overflow text */
        white-space: nowrap; /* Prevent text from wrapping into new lines */
    }

    .table th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    .table tr:hover {
        background-color: #f0f0f0;
    }

    .dataTables_scrollHead {
        height: 43px;
    }
</style>

@endsection
