@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Agenda PKK</h2>
    <!-- Tombol untuk menuju ke halaman sosialisasi-riksus.blade.php -->
    <a href="{{ route('penilaian-kemampuan.create') }}" class="btn btn-success">Add Data</a>
    </a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Hari/Tanggal</th>
                <th>Waktu</th>
                <th>Nama Perusahaan</th>
                <th>Peserta</th>
                <th>Jabatan</th>
                <th>Zoom</th>
                <th>PIC</th>
                <th>Penguji</th>
                <th>Hasil</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agendas as $index => $agenda)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $agenda->hari_tanggal }}</td>
                    <td>{{ $agenda->waktu }}</td>
                    <td>{{ $agenda->nama_perusahaan }}</td>
                    <td>{{ $agenda->peserta }}</td>
                    <td>{{ $agenda->jabatan }}</td>
                    <td>{{ $agenda->zoom }}</td>
                    <td>{{ $agenda->pic }}</td>
                    <td>{{ $agenda->penguji }}</td>
                    <td>{{ $agenda->hasil }}</td>
                    <td>
                        <a href="{{ route('pkk-agenda.edit', $agenda->id) }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
