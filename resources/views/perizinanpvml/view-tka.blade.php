@extends('layouts.app')

@section('content')
    <h1>Daftar TKA</h1>

    @if(session('success'))
        <div>
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <a href="{{ route('tka.create') }}">Tambah Data TKA</a>

    <table>
        <thead>
            <tr>
                <th>Jenis Industri</th>
                <th>Nama Perusahaan</th>
                <th>Nomor Surat Permohonan</th>
                <th>Tanggal Surat Permohonan</th>
                <th>Status Perizinan</th>
                <th>Jenis Output</th>
                <th>Tanggal Dokumen Lengkap</th>
                <th>No Surat Pencatatan</th>
                <th>Tanggal Surat Pencatatan</th>
                <th>Jumlah Hari Kerja</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tkas as $tka)
                <tr>
                    <td>{{ $tka->jenis_industri }}</td>
                    <td>{{ $tka->nama_perusahaan }}</td>
                    <td>{{ $tka->nomor_surat_permohonan }}</td>
                    <td>{{ $tka->tanggal_surat_permohonan }}</td>
                    <td>{{ $tka->status_perizinan }}</td>
                    <td>{{ $tka->jenis_output }}</td>
                    <td>{{ $tka->tanggal_dok_lengkap }}</td>
                    <td>{{ $tka->no_surat_pencatatan }}</td>
                    <td>{{ $tka->tanggal_surat_pencatatan }}</td>
                    <td>{{ $tka->jumlah_hari_kerja }}</td>
                    <td>
                        <a href="{{ route('tka.edit', $tka->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
