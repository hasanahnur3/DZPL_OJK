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
        overflow-x: hidden; /* Mencegah scroll horizontal di body */
    }

    .full-container {
        width: 100%; /* Pastikan 100% */
        min-height: 100vh;
        padding: 20px;
        background-color: white;
        display: flex; /* Untuk centering vertikal */
        flex-direction: column; /* Untuk centering vertikal */
        align-items: center; /* Untuk centering horizontal */
        justify-content: center; /* Untuk centering vertikal */
    }

    .table-container {
        width: 95%; /* Lebar tabel container */
        max-width: 95%; /* Maksimal lebar tabel container */
        margin: 20px auto;
        padding: 20px;
        background: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow-x: auto; /* Aktifkan scroll horizontal jika konten terlalu lebar */
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
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

    /* Style tambahan untuk tombol Add Data */
    .add-data-button {
        margin-bottom: 10px; /* Spasi di bawah tombol */
        display: inline-block; /* Agar tombol tampil di baris sendiri */
        margin-left: auto;
        margin-right: auto;
    }
</style>

<div class="full-container">
    <div class="table-container">
        <h2>Daftar LJK PVML</h2>
        <a href="{{ route('daftarljk.create') }}" class="btn btn-primary add-data-button">Add Data</a>

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