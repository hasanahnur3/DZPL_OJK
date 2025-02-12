@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Daftar Agenda Rapat Pimpinan</h2>


<div class="form-container" style="overflow-x: auto;">
<h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Daftar Rapat Pimpinan</h2>
    <table id="rapatTable" style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
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
            @foreach($rapim as $index => $item)
            <tr>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">{{ $index + 1 }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">{{ $item->tanggal }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">{{ $item->topik }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">{{ $item->hasil }}</td>
                <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                    <a href="{{ route('rapim.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="button-container">
    <a href="{{ route('rapat-pimpinan.create') }}" class="btn btn-success">Add Data</a>
</div>
</div>



<script>
    $(document).ready(function() {
        $('#rapatTable').DataTable();
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
    .btn-warning {
        background-color: #ffc107;
        border: 2px solid #ffc107;
        border-radius: 8px;
        padding: 5px 10px;
        color: white;
        text-decoration: none;
        display: inline-block;
    }
    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }
    table {
        width: 100%;
        table-layout: fixed;
    }
    th, td {
        padding: 0.75rem;
        border: 1px solid #dee2e6;
        word-wrap: break-word;
    }
</style>

@endsection
