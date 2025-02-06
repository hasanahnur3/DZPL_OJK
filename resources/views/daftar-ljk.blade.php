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
            @foreach ($kelembagaan as $data)
                <tr>
                    <td>{{ $data->jenis_industri }}</td>
                    <td>{{ $data->nama_perusahaan }}</td>
                    <td>{{ $data->detail_izin }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->nomor_surat_permohonan }}</td>
                    <td>{{ $data->tanggal_surat_permohonan }}</td>
                    <td>{{ $data->tanggal_pengajuan_sistem }}</td>
                    <td>{{ $data->tanggal_dokumen_lengkap }}</td>
                    <td>{{ $data->tanggal_selesai_analisis }}</td>
                    <td>{{ $data->sla }}</td>
                    <td>{{ $data->nomor_surat }}</td>
                    <td>{{ $data->tanggal_surat }}</td>
                    <td>{{ $data->jumlah_hari_kerja }}</td>
                    <td>{{ $data->aksi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endsection
