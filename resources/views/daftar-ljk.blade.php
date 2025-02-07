@extends('layouts.app')

@section('content')
    <h1>Daftar LJK PVML</h1>

    <table border="1">
        <thead>
            <tr>
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
            @foreach($ljkList as $ljk)
                <tr>
                    <td>{{ $ljk->jenis_industri }}</td>
                    <td>{{ $ljk->nama_perusahaan }}</td>
                    <td>{{ $ljk->detail_izin }}</td>
                    <td>{{ $ljk->status }}</td>
                    <td>{{ $ljk->nomor_surat_permohonan }}</td>
                    <td>{{ $ljk->tanggal_surat_permohonan }}</td>
                    <td>{{ $ljk->tanggal_pengajuan_sistem }}</td>
                    <td>{{ $ljk->tanggal_dokumen_lengkap }}</td>
                    <td>{{ $ljk->tanggal_selesai_analisis }}</td>
                    <td>{{ $ljk->sla }}</td>
                    <td>{{ $ljk->nomor_surat }}</td>
                    <td>{{ $ljk->tanggal_surat }}</td>
                    <td>{{ $ljk->jumlah_hari_kerja }}</td>
                    <td>{{ $ljk->aksi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endsection
