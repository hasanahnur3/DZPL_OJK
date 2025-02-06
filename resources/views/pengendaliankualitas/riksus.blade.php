@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Tambah Daftar Pengendalian Kualitas</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('riksus.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Kode Riskus*</label>
                    <input type="text" name="kode_riskus" class="form-control @error('kode_riskus') is-invalid @enderror" required>
                    @error('kode_riskus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Industri</label>
                    <select class="form-control @error('jenis_industri') is-invalid @enderror" name="jenis_industri">
                        <option value="">Pilih Jenis Industri</option>
                        <option value="Manufaktur">Manufaktur</option>
                        <option value="Jasa">Jasa</option>
                        <option value="Perdagangan">Perdagangan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No ND Pelimpahan</label>
                    <input type="text" name="no_nd_pelimpahan" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal ND Pelimpahan</label>
                    <input type="date" name="tanggal_nd_pelimpahan" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">No RKPK</label>
                    <input type="text" name="no_rkpk" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal RKPK</label>
                    <input type="date" name="tanggal_rkpk" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">No Surat Tugas</label>
                    <input type="text" name="no_surat_tugas" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Surat Tugas</label>
                    <input type="date" name="tanggal_surat_tugas" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Periode Pemeriksaan Surat Tugas</label>
                    <input type="text" name="periode_pemeriksaan_surat_tugas" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal QA</label>
                    <input type="date" name="tanggal_qa" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Expose</label>
                    <input type="date" name="tanggal_expose" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Paparan KE ke PVML</label>
                    <input type="text" name="paparan_ke_pvml" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">No ND ke DPJK</label>
                    <input type="text" name="no_nd_ke_dpjk" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal ND ke DPJK</label>
                    <input type="date" name="tanggal_nd_ke_dpjk" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">No BAST ke DPJK</label>
                    <input type="text" name="no_bast_ke_dpjk" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal BAST ke DPJK</label>
                    <input type="date" name="tanggal_bast_ke_dpjk" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">No LHPK ke DPJK</label>
                    <input type="text" name="no_lhpk_ke_dpjk" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal LHPK ke DPJK</label>
                    <input type="date" name="tanggal_lhpk_ke_dpjk" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">No ND Penyampaian LHPK Ke Pengawas DPJK</label>
                    <input type="date" name="no_nd_penyampaian_lhpk_ke_pengawas_dpjk" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal ND Penyampaian LHPK Ke Pengawas DPJK</label>
                    <input type="date" name="tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal KPKP</label>
                    <input type="date" name="tanggal_kpkp" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">No SIPUTR</label>
                    <input type="date" name="no_siputri" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal SIPUTRI</label>
                    <input type="date" name="tanggal_siputri" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Persetujuan Kadep</label>
                    <input type="date" name="tanggal_persetujuan_kadep" class="form-control">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection