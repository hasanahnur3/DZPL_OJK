@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="form-container" style="overflow-x: auto;">
    <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Daftar Direksi Komisaris</h2>
    <table id="dirkomTable" class="table" style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
        <thead style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
            <tr>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jenis Industri</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nama Perusahaan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nomor Surat Permohonan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Surat Permohonan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Status Perizinan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jenis Output</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Dokumen Lengkap</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">No Surat Tanggapan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Surat Tanggapan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">SLA</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; ">Created At</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; ">Updated At</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dirkoms as $dirkom)
                <tr>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $dirkom->jenis_industri }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $dirkom->nama_perusahaan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $dirkom->nomor_surat_permohonan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">
                        {{ \Carbon\Carbon::parse($dirkom->tanggal_surat_permohonan)->format('Y-m-d') }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $dirkom->status_perizinan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $dirkom->jenis_output }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">
                        {{ $dirkom->status_perizinan == 'selesai' ? '-' : ($dirkom->tanggal_dok_lengkap ? \Carbon\Carbon::parse($dirkom->tanggal_dok_lengkap)->format('Y-m-d') : '-') }}
                    </td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $dirkom->no_surat_pencatatan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">
                        {{ $dirkom->tanggal_surat_pencatatan ? \Carbon\Carbon::parse($dirkom->tanggal_surat_pencatatan)->format('Y-m-d') : '-' }}
                    </td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">
                            @php
                                if ($dirkom->status_perizinan == 'Selesai' || !$dirkom->tanggal_dok_lengkap) {
                                    echo '-';
                                } else {
                                    $today = new DateTime();
                                    $dokDate = new DateTime($dirkom->tanggal_dok_lengkap);
                                    
                                    // Count business days between dates (excluding weekends)
                                    $daysPassed = 0;
                                    $currentDate = clone $dokDate;
                                    
                                    while ($currentDate <= $today) {
                                        $weekDay = $currentDate->format('N');
                                        if ($weekDay < 6) { // 1 (Monday) to 5 (Friday)
                                            $daysPassed++;
                                        }
                                        $currentDate->modify('+1 day');
                                    }
                                    
                                    // Calculate SLA: 20 minus business days passed
                                    $sla = 20 - $daysPassed;
                                    
                                    // Color code based on SLA value
                                    $color = '';
                                    if ($sla < 0) {
                                        $color = 'color: red;';
                                    } elseif ($sla <= 5) {
                                        $color = 'color: orange;';
                                    } else {
                                        $color = 'color: green;';
                                    }
                                    
                                    echo "<span style='$color font-weight: bold;'>$sla</span>";
                                }
                            @endphp
                    </td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                                    {{ $dirkom->created_at ? $dirkom->created_at->format('d-m-Y H:i') : '-' }}
                                </td>
                                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                                    {{ $dirkom->updated_at ? $dirkom->updated_at->format('d-m-Y H:i') : '-' }}
                                </td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                        @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
                        <a href="{{ route('dirkom.edit', $dirkom->id) }}"
                            style="background-color: #007bff; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="text-align: right; margin-bottom: 1rem;" class="button-container">
        @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
        <a href="{{ route('dirkom.create') }}"
            style="background-color: #28a745; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;"
            class="btn btn-success">Tambah Data</a>
        @endif
    </div>
</div>

<script>
$(document).ready(function () {
    $('#dirkomTable').DataTable({
        scrollX: true,
        "pageLength": 6  // Tambahkan opsi ini untuk mendukung pengguliran horizontal
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
        overflow: hidden; /* Mencegah teks meluap dari kolom */
        text-overflow: ellipsis; /* Menambahkan ellipsis (...) jika teks terlalu panjang */
        white-space: nowrap; /* Mencegah teks wrap ke baris baru */
    }

    .table th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    .table tr:hover {
        background-color: #f0f0f0;
    }
    .dataTables_scrollHead{
        height: 43px;
    }
</style>
@endsection
