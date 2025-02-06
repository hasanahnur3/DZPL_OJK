@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Daftar Penilaian Kemampuan & Kepatutan</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('pkk.create') }}" class="btn btn-primary mb-4">Tambah Data</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jenis Industri</th>
                <th>Nama Perusahaan</th>
                <th>Nama Pihak Utama</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Nomor Surat Permohonan</th>
                <th>Tanggal Surat Permohonan</th>
                <th>Tanggal Pengajuan Sistem</th>
                <th>Tanggal Dokumen Lengkap</th>
                <th>Perlu Klarifikasi</th>
                <th>Tanggal Klarifikasi</th>
                <th>Hasil</th>
                <th>Nomor Persetujuan</th>
                <th>Tanggal Persetujuan</th>
                <th>Jumlah Hari Kerja</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->jenis_industri }}</td>
                    <td>{{ $item->nama_perusahaan }}</td>
                    <td>{{ $item->nama_pihak_utama }}</td>
                    <td>{{ $item->jabatan }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->nomor_surat_permohonan }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_surat_permohonan)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pengajuan_sistem)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_dok_lengkap)->format('d-m-Y') }}</td>
                    <td>{{ $item->perlu_klarifikasi }}</td>
                    <td>{{ $item->tanggal_klarifikasi ? \Carbon\Carbon::parse($item->tanggal_klarifikasi)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $item->hasil }}</td>
                    <td>{{ $item->nomor_persetujuan }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_persetujuan)->format('d-m-Y') }}</td>
                    <td>{{ $item->jumlah_hari_kerja }}</td>
                    <td>
                        <a href="{{ route('pkk.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
