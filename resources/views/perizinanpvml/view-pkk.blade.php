@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">


    
    
    <div class="form-container">
    <div style="overflow-x: auto; max-width: 100%;">
    <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;"> Daftar Pengajuan Penilaian Kemampuan & Kepatutan</h2>
        <table id="kepengurusanTable" class="table" style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
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
                @foreach($data as $item)
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
                            @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
                            <a href="{{ route('pkk.edit', $item->id) }}" style="background-color: #007bff; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;">Edit</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="text-align: right; margin-bottom: 1rem;" class="button-container">
    </div>
    

    <div style="text-align: right; margin-bottom: 1rem;" class="button-container">
        @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
        <a href="{{ route('pkk.create') }}" style="background-color: #28a745; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;" class="btn btn-success">Tambah Data</a>
        @endif



         
<script>
$(document).ready(function () {
    $('#kepengurusanTable').DataTable({
        scrollX: true, // Tambahkan opsi ini untuk mendukung pengguliran horizontal
    });
});
</script>
<style>

    .form-container{
        max-width: 100%;
        width: 100%;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }
    
    .button-container {
        display: flex;
        justify-content: end;
        margin-top: 20px;
    }

    .btn-success {
        background-color: #28a745;
        border: 2px solid #28a745;
        border-radius: 8px;
        padding: 10px 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: white;
        text-align: center;
        text-decoration: none;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    div.dataTables_wrapper {
        width: 100%;
        overflow-x: auto;  */
    }
    div.dataTables_scrollHead{
        margin-bottom: -25px;
    }

    table {
        max-width: 100%; 
    }

    .btn {
        display: inline-block;
        padding: 8px 16px;
        background-color: #ffc107;
        color: black;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: bold;
    }

    .btn:hover {
        background-color: #e0a800;
    }

    .btn-success {
        background-color: #28a745;
        border: 2px solid #28a745;
        border-radius: 8px;
        padding: 10px 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: white;
        text-align: center;
        text-decoration: none;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        
        margin-top: 20px;
    }

    .table th, .table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        overflow: hidden; /* Mencegah teks meluap dari kolom */
        text-overflow: ellipsis; /* Menambahkan ellipsis (...) jika teks terlalu panjang */
        white-space: nowrap; /* Mencegah teks wrap ke baris baru */
    }

    .table th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    .table tr:hover {
        background-color: #f0f0f0;
    }
</style>
@endsection
