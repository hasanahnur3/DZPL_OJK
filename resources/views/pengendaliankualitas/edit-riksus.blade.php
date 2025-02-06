@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Riksus</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('riksus.update', $riksus->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <!-- Field: Kode Riskus -->
                <div class="mb-3">
                    <label class="form-label">Kode Riskus*</label>
                    <input type="text" name="kode_riskus" class="form-control @error('kode_riskus') is-invalid @enderror" value="{{ old('kode_riskus', $riksus->kode_riskus) }}" required>
                    @error('kode_riskus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Jenis Industri -->
                <div class="mb-3">
                    <label class="form-label">Jenis Industri</label>
                    <input type="text" name="jenis_industri" class="form-control @error('jenis_industri') is-invalid @enderror" value="{{ old('jenis_industri', $riksus->jenis_industri) }}">
                    @error('jenis_industri')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Nama Perusahaan -->
                <div class="mb-3">
                    <label class="form-label">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" class="form-control @error('nama_perusahaan') is-invalid @enderror" value="{{ old('nama_perusahaan', $riksus->nama_perusahaan) }}">
                    @error('nama_perusahaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: No ND Pelimpahan -->
                <div class="mb-3">
                    <label class="form-label">No ND Pelimpahan</label>
                    <input type="text" name="no_nd_pelimpahan" class="form-control @error('no_nd_pelimpahan') is-invalid @enderror" value="{{ old('no_nd_pelimpahan', $riksus->no_nd_pelimpahan) }}">
                    @error('no_nd_pelimpahan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Tanggal ND Pelimpahan -->
                <div class="mb-3">
                    <label class="form-label">Tanggal ND Pelimpahan</label>
                    <input type="date" name="tanggal_nd_pelimpahan" class="form-control @error('tanggal_nd_pelimpahan') is-invalid @enderror" value="{{ old('tanggal_nd_pelimpahan', $riksus->tanggal_nd_pelimpahan) }}">
                    @error('tanggal_nd_pelimpahan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: No RKPK -->
                <div class="mb-3">
                    <label class="form-label">No RKPK</label>
                    <input type="text" name="no_rkpk" class="form-control @error('no_rkpk') is-invalid @enderror" value="{{ old('no_rkpk', $riksus->no_rkpk) }}">
                    @error('no_rkpk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Tanggal RKPK -->
                <div class="mb-3">
                    <label class="form-label">Tanggal RKPK</label>
                    <input type="date" name="tanggal_rkpk" class="form-control @error('tanggal_rkpk') is-invalid @enderror" value="{{ old('tanggal_rkpk', $riksus->tanggal_rkpk) }}">
                    @error('tanggal_rkpk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: No Surat Tugas -->
                <div class="mb-3">
                    <label class="form-label">No Surat Tugas</label>
                    <input type="text" name="no_surat_tugas" class="form-control @error('no_surat_tugas') is-invalid @enderror" value="{{ old('no_surat_tugas', $riksus->no_surat_tugas) }}">
                    @error('no_surat_tugas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Tanggal Surat Tugas -->
                <div class="mb-3">
                    <label class="form-label">Tanggal Surat Tugas</label>
                    <input type="date" name="tanggal_surat_tugas" class="form-control @error('tanggal_surat_tugas') is-invalid @enderror" value="{{ old('tanggal_surat_tugas', $riksus->tanggal_surat_tugas) }}">
                    @error('tanggal_surat_tugas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Periode Pemeriksaan Surat Tugas -->
                <div class="mb-3">
                    <label class="form-label">Periode Pemeriksaan Surat Tugas</label>
                    <input type="text" name="periode_pemeriksaan_surat_tugas" class="form-control @error('periode_pemeriksaan_surat_tugas') is-invalid @enderror" value="{{ old('periode_pemeriksaan_surat_tugas', $riksus->periode_pemeriksaan_surat_tugas) }}">
                    @error('periode_pemeriksaan_surat_tugas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Tanggal QA -->
                <div class="mb-3">
                    <label class="form-label">Tanggal QA</label>
                    <input type="date" name="tanggal_qa" class="form-control @error('tanggal_qa') is-invalid @enderror" value="{{ old('tanggal_qa', $riksus->tanggal_qa) }}">
                    @error('tanggal_qa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Tanggal Expose -->
                <div class="mb-3">
                    <label class="form-label">Tanggal Expose</label>
                    <input type="date" name="tanggal_expose" class="form-control @error('tanggal_expose') is-invalid @enderror" value="{{ old('tanggal_expose', $riksus->tanggal_expose) }}">
                    @error('tanggal_expose')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Paparan ke PVML -->
                <div class="mb-3">
                    <label class="form-label">Paparan ke PVML</label>
                    <input type="text" name="paparan_ke_pvml" class="form-control @error('paparan_ke_pvml') is-invalid @enderror" value="{{ old('paparan_ke_pvml', $riksus->paparan_ke_pvml) }}">
                    @error('paparan_ke_pvml')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: No ND ke DPJK -->
                <div class="mb-3">
                    <label class="form-label">No ND ke DPJK</label>
                    <input type="text" name="no_nd_ke_dpjk" class="form-control @error('no_nd_ke_dpjk') is-invalid @enderror" value="{{ old('no_nd_ke_dpjk', $riksus->no_nd_ke_dpjk) }}">
                    @error('no_nd_ke_dpjk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Tanggal ND ke DPJK -->
                <div class="mb-3">
                    <label class="form-label">Tanggal ND ke DPJK</label>
                    <input type="date" name="tanggal_nd_ke_dpjk" class="form-control @error('tanggal_nd_ke_dpjk') is-invalid @enderror" value="{{ old('tanggal_nd_ke_dpjk', $riksus->tanggal_nd_ke_dpjk) }}">
                    @error('tanggal_nd_ke_dpjk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: No BAST ke DPJK -->
                <div class="mb-3">
                    <label class="form-label">No BAST ke DPJK</label>
                    <input type="text" name="no_bast_ke_dpjk" class="form-control @error('no_bast_ke_dpjk') is-invalid @enderror" value="{{ old('no_bast_ke_dpjk', $riksus->no_bast_ke_dpjk) }}">
                    @error('no_bast_ke_dpjk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Tanggal BAST ke DPJK -->
                <div class="mb-3">
                    <label class="form-label">Tanggal BAST ke DPJK</label>
                    <input type="date" name="tanggal_bast_ke_dpjk" class="form-control @error('tanggal_bast_ke_dpjk') is-invalid @enderror" value="{{ old('tanggal_bast_ke_dpjk', $riksus->tanggal_bast_ke_dpjk) }}">
                    @error('tanggal_bast_ke_dpjk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: No LHPK ke DPJK -->
                <div class="mb-3">
                    <label class="form-label">No LHPK ke DPJK</label>
                    <input type="text" name="no_lhpk_ke_dpjk" class="form-control @error('no_lhpk_ke_dpjk') is-invalid @enderror" value="{{ old('no_lhpk_ke_dpjk', $riksus->no_lhpk_ke_dpjk) }}">
                    @error('no_lhpk_ke_dpjk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Tanggal LHPK ke DPJK -->
                <div class="mb-3">
                    <label class="form-label">Tanggal LHPK ke DPJK</label>
                    <input type="date" name="tanggal_lhpk_ke_dpjk" class="form-control @error('tanggal_lhpk_ke_dpjk') is-invalid @enderror" value="{{ old('tanggal_lhpk_ke_dpjk', $riksus->tanggal_lhpk_ke_dpjk) }}">
                    @error('tanggal_lhpk_ke_dpjk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: No ND Penyampaian LHPK ke Pengawas DPJK -->
                <div class="mb-3">
                    <label class="form-label">No ND Penyampaian LHPK ke Pengawas DPJK</label>
                    <input type="text" name="no_nd_penyampaian_lhpk_ke_pengawas_dpjk" class="form-control @error('no_nd_penyampaian_lhpk_ke_pengawas_dpjk') is-invalid @enderror" value="{{ old('no_nd_penyampaian_lhpk_ke_pengawas_dpjk', $riksus->no_nd_penyampaian_lhpk_ke_pengawas_dpjk) }}">
                    @error('no_nd_penyampaian_lhpk_ke_pengawas_dpjk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Tanggal ND Penyampaian LHPK ke Pengawas DPJK -->
                <div class="mb-3">
                    <label class="form-label">Tanggal ND Penyampaian LHPK ke Pengawas DPJK</label>
                    <input type="date" name="tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk" class="form-control @error('tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk') is-invalid @enderror" value="{{ old('tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk', $riksus->tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk) }}">
                    @error('tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Tanggal KPKP -->
                <div class="mb-3">
                    <label class="form-label">Tanggal KPKP</label>
                    <input type="date" name="tanggal_kpkp" class="form-control @error('tanggal_kpkp') is-invalid @enderror" value="{{ old('tanggal_kpkp', $riksus->tanggal_kpkp) }}">
                    @error('tanggal_kpkp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: No SIPUTRI -->
                <div class="mb-3">
                    <label class="form-label">No SIPUTRI</label>
                    <input type="text" name="no_siputri" class="form-control @error('no_siputri') is-invalid @enderror" value="{{ old('no_siputri', $riksus->no_siputri) }}">
                    @error('no_siputri')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Tanggal SIPUTRI -->
                <div class="mb-3">
                    <label class="form-label">Tanggal SIPUTRI</label>
                    <input type="date" name="tanggal_siputri" class="form-control @error('tanggal_siputri') is-invalid @enderror" value="{{ old('tanggal_siputri', $riksus->tanggal_siputri) }}">
                    @error('tanggal_siputri')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Field: Tanggal Persetujuan Kadep -->
                <div class="mb-3">
                    <label class="form-label">Tanggal Persetujuan Kadep</label>
                    <input type="date" name="tanggal_persetujuan_kadep" class="form-control @error('tanggal_persetujuan_kadep') is-invalid @enderror" value="{{ old('tanggal_persetujuan_kadep', $riksus->tanggal_persetujuan_kadep) }}">
                    @error('tanggal_persetujuan_kadep')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
