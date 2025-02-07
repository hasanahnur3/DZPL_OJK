@extends('layouts.app')

@section('content')
<style>
    .container-fluid {
        padding: 20px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .btn-add {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 10px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
        background-color: #fff;
    }

    .table th, .table td {
        border: 1px solid #dee2e6;
        padding: 10px;
        text-align: center;
        white-space: nowrap;
    }

    .table thead {
        background-color: #007bff;
        color: white;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>

<div class="container-fluid">
    <h2>Daftar Riksus</h2>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="btn-add">
        <a href="{{ route('riksus.create') }}" class="btn btn-primary">Tambah Data Riksus</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Riskus</th>
                    <th>Jenis Industri</th>
                    <th>Nama Perusahaan</th>
                    <th>No ND Pelimpahan</th>
                    <th>Tanggal ND Pelimpahan</th>
                    <th>No RKPK</th>
                    <th>Tanggal RKPK</th>
                    <th>No Surat Tugas</th>
                    <th>Tanggal Surat Tugas</th>
                    <th>Periode Pemeriksaan</th>
                    <th>Tanggal QA</th>
                    <th>Tanggal Expose</th>
                    <th>Paparan Ke PVML</th>
                    <th>No ND Ke DPJK</th>
                    <th>Tanggal ND Ke DPJK</th>
                    <th>No BAST Ke DPJK</th>
                    <th>Tanggal BAST Ke DPJK</th>
                    <th>No LHPK Ke DPJK</th>
                    <th>Tanggal LHPK Ke DPJK</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riksus as $riksusItem)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $riksusItem->kode_riskus }}</td>
                    <td>{{ $riksusItem->jenis_industri }}</td>
                    <td>{{ $riksusItem->nama_perusahaan }}</td>
                    <td>{{ $riksusItem->no_nd_pelimpahan }}</td>
                    <td>{{ $riksusItem->tanggal_nd_pelimpahan ? \Carbon\Carbon::parse($riksusItem->tanggal_nd_pelimpahan)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $riksusItem->no_rkpk }}</td>
                    <td>{{ $riksusItem->tanggal_rkpk ? \Carbon\Carbon::parse($riksusItem->tanggal_rkpk)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $riksusItem->no_surat_tugas }}</td>
                    <td>{{ $riksusItem->tanggal_surat_tugas ? \Carbon\Carbon::parse($riksusItem->tanggal_surat_tugas)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $riksusItem->periode_pemeriksaan_surat_tugas }}</td>
                    <td>{{ $riksusItem->tanggal_qa ? \Carbon\Carbon::parse($riksusItem->tanggal_qa)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $riksusItem->tanggal_expose ? \Carbon\Carbon::parse($riksusItem->tanggal_expose)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $riksusItem->paparan_ke_pvml }}</td>
                    <td>{{ $riksusItem->no_nd_ke_dpjk }}</td>
                    <td>{{ $riksusItem->tanggal_nd_ke_dpjk ? \Carbon\Carbon::parse($riksusItem->tanggal_nd_ke_dpjk)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $riksusItem->no_bast_ke_dpjk }}</td>
                    <td>{{ $riksusItem->tanggal_bast_ke_dpjk ? \Carbon\Carbon::parse($riksusItem->tanggal_bast_ke_dpjk)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $riksusItem->no_lhpk_ke_dpjk }}</td>
                    <td>{{ $riksusItem->tanggal_lhpk_ke_dpjk ? \Carbon\Carbon::parse($riksusItem->tanggal_lhpk_ke_dpjk)->format('d-m-Y') : '-' }}</td>
                    <td>
                        <a href="{{ route('riksus.edit', $riksusItem->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('riksus.destroy', $riksusItem->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection