@extends('layouts.app')

@section('content')
    <h1>Data Sosialisasi Riksus</h1>

    <!-- Tombol untuk menuju ke halaman sosialisasi-riksus.blade.php -->
    <a href="{{ route('sosialisasi-riksus.index') }}">
        <button type="button">Add Data</button>
    </a>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Sosialisasi</th>
                <th>Hari/Tanggal</th>
                <th>Tempat</th>
                <th>Keterangan Peserta</th>
                <th>Kesimpulan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                <td>{{ $item->judul_sosialisasi }}</td> <!-- Menampilkan judul sosialisasi -->
                <td>{{ $item->hari_tanggal }}</td> <!-- Menampilkan hari/tanggal -->
                <td>{{ $item->tempat }}</td> <!-- Menampilkan tempat -->
                <td>{{ $item->keterangan_peserta }}</td> <!-- Menampilkan keterangan peserta -->
                <td>{{ $item->kesimpulan }}</td> <!-- Menampilkan kesimpulan -->
                <td>
                    <!-- Tombol Edit -->
                    <a href="{{ route('sosialisasi-riksus.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    
                    <!-- Tombol Delete -->
                    <form action="{{ route('sosialisasi-riksus.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>                
            </tr>
            @endforeach
        </tbody>
    </table>
    @endsection