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
            overflow: hidden;
            overflow-x: hidden;
            /* Mencegah scroll horizontal di body */
        }

        .full-container {
            width: 100%;
            /* Pastikan 100% */
            min-height: 100vh;
            padding: 20px;
            background-color: white;
            display: flex;
            /* Untuk centering vertikal */
            flex-direction: column;
            /* Untuk centering vertikal */
            align-items: center;
            /* Untuk centering horizontal */
            justify-content: center;
            /* Untuk centering vertikal */
        }

        .table-container {
            width: 95%;
            /* Lebar tabel container */
            max-width: 95%;
            /* Maksimal lebar tabel container */
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow-x: auto;
            /* Aktifkan scroll horizontal jika konten terlalu lebar */
            display: flex;
            flex-direction: column;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Menambahkan style untuk tombol Add Data agar berada di kanan */
        .add-data-button {
            margin-bottom: 10px;
            /* Spasi di bawah tombol */
            display: inline-block;
            /* Agar tombol tampil di baris sendiri */
            margin-left: auto;
            /* Memindahkan tombol ke kanan */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Ini kunci untuk membuat kolom compact */
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            overflow: hidden;
            /* Mencegah teks meluap dari kolom */
            text-overflow: ellipsis;
            /* Menambahkan ellipsis (...) jika teks terlalu panjang */
            white-space: nowrap;
            /* Mencegah teks wrap ke baris baru */
        }

        .table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        /* Menambahkan style khusus untuk kolom Aksi agar berada di kanan */
        .table th:last-child,
        .table td:last-child {
            text-align: right;
            /* Posisikan konten di kolom Aksi ke kanan */
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
    </style>

    <!-- Tambahkan CDN DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <div class="full-container">
        <div class="table-container">
            <h2>Daftar LJK PVML</h2>


            <table class="table">
                <thead>
                    <tr>
                        <th>Jenis Industri</th>
                        <th>Nama Perusahaan</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ljkList as $ljk)
                        <tr>
                            <td>{{ $ljk->jenis_industri }}</td>
                            <td>{{ $ljk->nama_perusahaan }}</td>
                            <td style="text-align:center;">
                                @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
                                    <a href="{{ route('daftarljk.edit', $ljk->id) }}" class="btn">Edit</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Tombol Add Data hanya muncul jika role bukan direktur, deputi, atau kadep -->
            @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
                <a href="{{ route('daftarljk.create') }}" class="btn btn-primary add-data-button"
                    style="background-color: #28a745; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;"
                    class="btn btn-success">Add Data</a>
            @endif
        </div>
    </div>

    <!-- Tambahkan CDN DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                "pageLength": 6
            }); // Inisialisasi DataTables pada tabel dengan class "table"
        });
    </script>

@endsection