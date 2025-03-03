@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="form-container" style="overflow-x: auto;">
    <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Daftar Agenda Lainnya</h2>
    <table id="agendaLainnyaTable" class="table" style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
        <thead style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
            <tr>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center; width:5%;">No</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center; width:20%;">Hari/Tanggal</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center; width:30%;">Topik</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center; width:35%;">Hasil</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center; width:10%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agendaLainnya as $index => $item)
            <tr>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">{{ $index + 1 }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">{{ $item->tanggal }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">{{ $item->topik }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">{{ $item->hasil }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                    @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
                    <a href="{{ route('agenda-lainnya.edit', $item->id) }}" style="background-color: #007bff; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;">Edit</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="button-container">
        @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
        <a href="{{ route('agenda-lainnya.create') }}" class="btn btn-success">Add Data</a>
        @endif
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#agendaLainnyaTable').DataTable({
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

    .table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed; /* Ini kunci untuk membuat kolom compact */
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
