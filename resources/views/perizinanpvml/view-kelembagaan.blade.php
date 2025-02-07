@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Daftar Kelembagaan PVML</h2>
            <div class="float-right">
                <a href="{{ route('kelembagaan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="kelembagaanTable">
                    <thead>
                        <tr>
                            <th>No</th>
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
                        @foreach($kelembagaan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->jenis_industri }}</td>
                            <td>{{ $item->nama_perusahaan }}</td>
                            <td>{{ $item->detail_izin ?? '-' }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->nomor_surat_permohonan ?? '-' }}</td>
                            <td>{{ $item->tanggal_surat_permohonan ? date('d-m-Y', strtotime($item->tanggal_surat_permohonan)) : '-' }}</td>
                            <td>{{ $item->tanggal_pengajuan_sistem ? date('d-m-Y', strtotime($item->tanggal_pengajuan_sistem)) : '-' }}</td>
                            <td>{{ $item->tanggal_dokumen_lengkap ? date('d-m-Y', strtotime($item->tanggal_dokumen_lengkap)) : '-' }}</td>
                            <td>{{ $item->tanggal_selesai_analisis ? date('d-m-Y', strtotime($item->tanggal_selesai_analisis)) : '-' }}</td>
                            <td>{{ $item->sla ?? '-' }}</td>
                            <td>{{ $item->nomor_surat ?? '-' }}</td>
                            <td>{{ $item->tanggal_surat ? date('d-m-Y', strtotime($item->tanggal_surat)) : '-' }}</td>
                            <td>{{ $item->jumlah_hari_kerja ?? '-' }}</td>
                            <td>
                                <a href="{{ route('kelembagaan.edit', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#kelembagaanTable').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 10,
        });
    });
</script>
@endpush
@endsection