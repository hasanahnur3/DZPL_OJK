@extends('layouts.app')

@section('content')
<div >
    <h1>Daftar Rapat Pimpinan</h1>


    <table class="table table-bordered mt-3"style="border-collapse: collapse; width: 100%; margin-top:20px;">
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
                <td style="border: 1px solid black; text-align: center; word-wrap: break-word; white-space: normal; max-width: 250px;" >{{ $item->topik }}</td>
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
    /* Styling untuk container tombol */
    .button-container {
        display: flex;
        justify-content: flex-end; /* Posisikan tombol di sudut kanan */
        margin-top: 20px;
    }

    /* Styling untuk tombol */
    .btn-success {
        background-color: #28a745; /* Hijau standar Bootstrap */
        border: 2px solid #28a745; /* Tambahkan frame di sekeliling tombol */
        border-radius: 8px; /* Membuat sudut tombol membulat */
        padding: 10px 20px; /* Menambah ruang di dalam tombol */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Efek bayangan */
        color: white; /* Warna teks putih */
        text-align: center;
        text-decoration: none; /* Hilangkan garis bawah */
    }

    .btn-success:hover {
        background-color: #218838; /* Warna tombol saat hover */
        border-color: #1e7e34; /* Warna border saat hover */
    }

        /* Atur tampilan kolom Topik dan Hasil */
        td {
        word-wrap: break-word; /* Bungkus teks panjang ke baris baru */
        white-space: normal; /* Izinkan pembungkusan teks */
    }

    /* Atur lebar maksimal untuk kolom */
    td:nth-child(3), /* Kolom Topik */
    td:nth-child(4) { /* Kolom Hasil */
        max-width: 250px; /* Atur lebar maksimal */
    }

    
</style>

@endsection