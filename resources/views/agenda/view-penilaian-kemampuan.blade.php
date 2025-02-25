@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">





<div class="form-container" style="overflow-x: auto;">
    <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Daftar Agenda PKK</h2>
    <table id="pkkTable" class="table" style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
        <thead style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
            <tr>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">No</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Hari/Tanggal</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Waktu</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nama Perusahaan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Peserta</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jabatan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Zoom</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">PIC</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Penguji 1</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Penguji 2</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Penguji 3</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Hasil</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agendas as $index => $agenda)
                <tr>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $loop->iteration }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $agenda->hari_tanggal }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $agenda->waktu }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $agenda->nama_perusahaan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $agenda->peserta }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $agenda->jabatan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $agenda->zoom }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $agenda->pic }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $agenda->penguji }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $agenda->penguji1 }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $agenda->penguji2 }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $agenda->hasil }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                        @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
                        <a href="{{ route('pkk-agenda.edit', $agenda->id) }}"
                            style="background-color: #007bff; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="button-container">
        @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
        <a href="{{ route('penilaian-kemampuan.create') }}" class="btn-success">Add Data</a>
        @endif
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#pkkTable').DataTable({
            "pageLength": 6 // Menampilkan 6 entri per halaman
        });
    });
</script>
<style>
    .form-container {
        max-width: 94%;
        width: 100%;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: white;
    }

    .button-container {
        display: flex;
        justify-content: flex-end;
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
        margin-top: 20px;
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
</style>

@endsection