@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    .full-container {
        width: 100vw; /* Full width */
        min-height: 100vh; /* Full height */
        padding: 20px;
        background-color: white;
    }

    .table-container {
        max-width: 95%;
        margin: 20px auto;
        padding: 20px;
        background: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow-x: auto; /* Agar tabel tidak pecah di layar kecil */
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
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
    }

    .table th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    .table tr:hover {
        background-color: #f0f0f0;
    }

    /* Tombol Edit */
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
</style>

<div class="full-container">
    <div class="table-container">
        <h2>Daftar LJK PVML</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Jenis Industri</th>
                    <th>Nama Perusahaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ljkList as $ljk)
                <tr>
                    <td>{{ $ljk->jenis_industri }}</td>
                    <td>{{ $ljk->nama_perusahaan }}</td>
                    <td>
                        <a href="{{ route('daftarljk.edit', $ljk->id) }}" class="btn">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
