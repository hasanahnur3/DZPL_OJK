@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 1200px; margin: auto; padding: 2rem; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Data Penilaian Kepengurusan</h2>

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #28a745; color: white; padding: 0.75rem; border-radius: 4px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    <div style="text-align: right; margin-bottom: 1rem;">
        <a href="{{ route('kepengurusan.create') }}" class="btn btn-success" style="background-color: #28a745; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;">Tambah Data</a>
    </div>

    <div style="overflow-x: auto;">
        <table border="1" style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem;">
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
                    <th>Tanggal Dok Lengkap</th>
                    <th>Perlu Klarifikasi</th>
                    <th>Tanggal Klarifikasi</th>
                    <th>Hasil</th>
                    <th>Nomor Persetujuan</th>
                    <th>Tanggal Persetujuan</th>
                    <th>Jumlah Hari Kerja</th>
                    <th>Jumlah Hari Kerja</th>
                    <th>Jumlah Hari Kerja</th>
                    <th>Jumlah Hari Kerja</th>
                    <th>Jumlah Hari Kerja</th>
                    <th>Jumlah Hari Kerja</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penilaian as $item)
                    <tr>
                        <td>{{ $item->jenis_industri }}</td>
                        <td>{{ $item->nama_perusahaan }}</td>
                        <td>{{ $item->nama_pihak_utama }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->nomor_surat_permohonan }}</td>
                        <td>{{ $item->tanggal_surat_permohonan }}</td>
                        <td>{{ $item->tanggal_pengajuan_sistem }}</td>
                        <td>{{ $item->tanggal_dok_lengkap }}</td>
                        <td>{{ $item->perlu_klarifikasi }}</td>
                        <td>{{ $item->tanggal_klarifikasi }}</td>
                        <td>{{ $item->hasil }}</td>
                        <td>{{ $item->nomor_persetujuan }}</td>
                        <td>{{ $item->tanggal_persetujuan }}</td>
                        <td>{{ $item->jumlah_hari_kerja }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="{{ route('kepengurusan.edit', $item->id) }}" class="btn btn-primary" style="background-color: #007bff; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection