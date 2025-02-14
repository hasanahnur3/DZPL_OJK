@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">



<div class="form-container" style="overflow-x: auto;">
<h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Daftar TKA</h2>
    <table id="tkaTable" style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
        <thead style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
            <tr>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jenis Industri</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nama Perusahaan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nomor Surat Permohonan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Surat Permohonan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Status Perizinan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jenis Output</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Dokumen Lengkap</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">No Surat Pencatatan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tanggal Surat Pencatatan</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jumlah Hari Kerja</th>
                <th style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tkas as $tka)
                <tr>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $tka->jenis_industri }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $tka->nama_perusahaan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $tka->nomor_surat_permohonan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $tka->tanggal_surat_permohonan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $tka->status_perizinan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $tka->jenis_output }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $tka->tanggal_dok_lengkap }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $tka->no_surat_pencatatan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $tka->tanggal_surat_pencatatan }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6;">{{ $tka->jumlah_hari_kerja }}</td>
                    <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                        @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
                        <a href="{{ route('tka.edit', $tka->id) }}" style="background-color: #007bff; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="text-align: right; margin-bottom: 1rem;" class="button-container">
        @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
    <a href="{{ route('tka.create') }}" style="background-color: #28a745; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;" class="btn btn-success">Tambah Data</a>
    @endif
</div>
</div>



<script>
    $(document).ready(function () {
        $('#tkaTable').DataTable();
    });
</script>
<style>

.form-container {
        max-width: 100%;
        width: 100%;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: white;
        /* display: flex;
        justify-content: center; */
    }
    .button-container {
        display: absolute;
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
</style>
@endsection
