@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Daftar Forum Panels</h2>

<div style="overflow-x: auto;">
    <table id="forumPanelTable"
        style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
        <thead style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
            <tr>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">No</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nama Perusahaan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Hari Pelaksanaan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Waktu</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tempat Pelaksanaan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Kriteria</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jenis Industri</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Hasil</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($forumPanels as $index => $panel)
                <tr>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">{{ $index + 1 }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $panel->nama_perusahaan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $panel->hari_pelaksanaan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $panel->waktu }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $panel->tempat_pelaksanaan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $panel->kriteria }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $panel->jenis_industri }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $panel->hasil }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">
                        <div style="display: flex; justify-content: flex-start; gap: 10px;">
                            <a href="{{ route('forum-panel.edit', $panel->id) }}"
                                style="background-color: #ffc107; color: black; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;">Edit</a>
                            <form action="{{ route('forum-panel.destroy', $panel->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="background-color: #dc3545; color: white; padding: 0.5rem 1rem; border: none; border-radius: 4px; cursor: pointer;">Delete</button>
                            </form>
                        </div>
                    </td>
            @endforeach
        </tbody>
    </table>
    <div class="button-container">
        <a href="{{ route('forum-panel.create') }}" class="btn btn-success">Add Data</a>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#forumPanelTable').DataTable();
    });
</script>

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
</style>

@endsection