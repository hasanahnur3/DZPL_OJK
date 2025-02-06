@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div>
    <h1>Daftar Rapat Pimpinan</h1>

    <table id="rapatTable" class="table table-bordered mt-3" style="border-collapse: collapse; width: 100%; margin-top:20px;">
        <thead>
            <tr style="border: 1px solid black;">
                <th style="border: 1px solid black; text-align: center; padding:5px;">No</th>
                <th style="border: 1px solid black; text-align: center;">Hari/Tanggal</th>
                <th style="border: 1px solid black; text-align: center;">Topik</th>
                <th style="border: 1px solid black; text-align: center;">Hasil</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rapim as $index => $item)
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; text-align: center; padding:10px;">{{ $index + 1 }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $item->tanggal }}</td>
                <td style="border: 1px solid black; text-align: center; word-wrap: break-word; white-space: normal; max-width: 250px;">{{ $item->topik }}</td>
                <td style="border: 1px solid black; text-align: center; word-wrap: break-word; white-space: normal; max-width: 250px;">{{ $item->hasil }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="button-container">
        <a href="{{ route('rapat-pimpinan.create') }}" class="btn btn-success">Add Data</a>
    </div>
</div>

<style>
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
    td {
        word-wrap: break-word;
        white-space: normal;
    }
    td:nth-child(3), td:nth-child(4) {
        max-width: 250px;
    }
</style>

<script>
    $(document).ready(function() {
        $('#rapatTable').DataTable();
    });
</script>

@endsection