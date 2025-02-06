@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Daftar Riksus</h2>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('riksus.create') }}" class="btn btn-primary mb-3">Tambah Data Riksus</a>

    <table class="table">
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
                <th>Periode Pemeriksaan Surat Tugas</th>
                <th>Tanggal QA</th>
                <th>Tanggal Expose</th>
                <th>Paparan Ke PVML</th>
                <th>No ND Ke DPJK</th>
                <th>Tanggal ND Ke DPJK</th>
                <th>No BAST Ke DPJK</th>
                <th>Tanggal BAST Ke DPJK</th>
                <th>No LHPK Ke DPJK</th>
                <th>Tanggal LHPK Ke DPJK</th>
                <th>No ND Penyampaian LHPK Ke Pengawas DPJK</th>
                <th>Tanggal ND Penyampaian LHPK Ke Pengawas DPJK</th>
                <th>Tanggal KPKP</th>
                <th>No SIPUTRI</th>
                <th>Tanggal SIPUTRI</th>
                <th>Tanggal Persetujuan Kadep</th>
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
                <td>{{ $riksusItem->no_nd_penyampaian_lhpk_ke_pengawas_dpjk }}</td>
                <td>{{ $riksusItem->tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk ? \Carbon\Carbon::parse($riksusItem->tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk)->format('d-m-Y') : '-' }}</td>
                <td>{{ $riksusItem->tanggal_kpkp ? \Carbon\Carbon::parse($riksusItem->tanggal_kpkp)->format('d-m-Y') : '-' }}</td>
                <td>{{ $riksusItem->no_siputri }}</td>
                <td>{{ $riksusItem->tanggal_siputri ? \Carbon\Carbon::parse($riksusItem->tanggal_siputri)->format('d-m-Y') : '-' }}</td>
                <td>{{ $riksusItem->tanggal_persetujuan_kadep ? \Carbon\Carbon::parse($riksusItem->tanggal_persetujuan_kadep)->format('d-m-Y') : '-' }}</td>
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
@endsection
