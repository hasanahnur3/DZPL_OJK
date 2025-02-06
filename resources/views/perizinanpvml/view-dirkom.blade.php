@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Daftar Direksi Komisaris
                    <a href="{{ route('dirkom.create') }}" class="btn btn-primary float-end">Tambah Data</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dirkoms as $dirkom)
                                <tr>
                                    <td>{{ $dirkom->jenis_industri }}</td>
                                    <td>{{ $dirkom->nama_perusahaan }}</td>
                                    <td>{{ $dirkom->nomor_surat_permohonan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($dirkom->tanggal_surat_permohonan)->format('Y-m-d') }}</td>
                                    <td>{{ $dirkom->status_perizinan }}</td>
                                    <td>{{ $dirkom->jenis_output }}</td>
                                    <td>{{ $dirkom->tanggal_dok_lengkap ? \Carbon\Carbon::parse($dirkom->tanggal_dok_lengkap)->format('Y-m-d') : '-' }}</td>
                                    <td>{{ $dirkom->no_surat_pencatatan }}</td>
                                    <td>{{ $dirkom->tanggal_surat_pencatatan ? \Carbon\Carbon::parse($dirkom->tanggal_surat_pencatatan)->format('Y-m-d') : '-' }}</td>
                                    <td>
                                        <a href="{{ route('dirkom.edit', $dirkom->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
