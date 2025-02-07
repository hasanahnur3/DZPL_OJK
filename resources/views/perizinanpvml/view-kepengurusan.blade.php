@extends('layouts.app')

@section('content')


    <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Data Penilaian Kepengurusan</h2>
    
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
            <thead style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
            <thead style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                <tr>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jenis Industri</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nama Perusahaan</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nama Pihak Utama</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jabatan</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Status</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nomor Surat Permohonan</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Surat Permohonan</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Pengajuan Sistem</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Dok Lengkap</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Perlu Klarifikasi</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Klarifikasi</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Hasil</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nomor Persetujuan</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Persetujuan</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jumlah Hari Kerja</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">Action</th> 
                </tr>
            </thead>
            <tbody>
                @foreach($penilaian as $item)
                    <tr>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->jenis_industri }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->nama_perusahaan }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->nama_pihak_utama }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->jabatan }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->status }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->nomor_surat_permohonan }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->tanggal_surat_permohonan }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->tanggal_pengajuan_sistem }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->tanggal_dok_lengkap }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->perlu_klarifikasi }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->tanggal_klarifikasi }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->hasil }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->nomor_persetujuan }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->tanggal_persetujuan }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $item->jumlah_hari_kerja }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                            <a href="{{ route('kepengurusan.edit', $item->id) }}" style="background-color: #007bff; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div style="text-align: right; margin-bottom: 1rem;">
        <a href="{{ route('kepengurusan.create') }}" style="background-color: #28a745; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;">Tambah Data</a>
         

@endsection
