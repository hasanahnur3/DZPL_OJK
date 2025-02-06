@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Kelembagaan PVML</h2>
    <a href="{{ route('kelembagaan.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Jenis Industri</th>
                <th>Nama Perusahaan</th>
                <th>Detail Izin</th>
                <th>Status</th>
                <th>Nomor Surat Permohonan</th>
                <th>Tanggal Surat Permohonan</th>
                <th>Tanggal Pengajuan Sistem</th>
                <th>Tanggal Dokumen Lengkap</th>
                <th>Tanggal Selesai Analisis</th>
                <th>SLA</th>
                <th>Nomor Surat</th>
                <th>Tanggal Surat</th>
                <th>Jumlah Hari Kerja</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kelembagaan as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->jenis_industri }}</td>
                <td>{{ $item->nama_perusahaan }}</td>
                <td>{{ $item->detail_izin }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->nomor_surat_permohonan }}</td>
                <td>{{ $item->tanggal_surat_permohonan }}</td>
                <td>{{ $item->tanggal_pengajuan_sistem }}</td>
                <td>{{ $item->tanggal_dokumen_lengkap }}</td>
                <td>{{ $item->tanggal_selesai_analisis }}</td>
                <td>{{ $item->sla }}</td>
                <td>{{ $item->nomor_surat }}</td>
                <td>{{ $item->tanggal_surat }}</td>
                <td>{{ $item->jumlah_hari_kerja }}</td>
                <td>
                    <a href="{{ route('kelembagaan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
