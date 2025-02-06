@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Daftar Direksi Komisaris</div>

                <div class="card-body">
                    <form action="{{ route('dirkom') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="jenis_industri">Jenis Industri</label>
                            <select class="form-control @error('jenis_industri') is-invalid @enderror" id="jenis_industri" name="jenis_industri" required>
                                <option value="">Pilih Jenis Industri</option>
                                <option value="Manufaktur">Manufaktur</option>
                                <option value="Jasa">Jasa</option>
                                <option value="Perdagangan">Perdagangan</option>
                                <!-- Tambahkan opsi lain sesuai kebutuhan -->
                            </select>
                            @error('jenis_industri')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" id="nama_perusahaan" name="nama_perusahaan" required>
                            @error('nama_perusahaan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nomor_surat_permohonan">Nomor Surat Permohonan</label>
                            <input type="text" class="form-control @error('nomor_surat_permohonan') is-invalid @enderror" id="nomor_surat_permohonan" name="nomor_surat_permohonan" required>
                            @error('nomor_surat_permohonan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_surat_permohonan">Tanggal Surat Permohonan</label>
                            <input type="date" class="form-control @error('tanggal_surat_permohonan') is-invalid @enderror" id="tanggal_surat_permohonan" name="tanggal_surat_permohonan" required>
                            @error('tanggal_surat_permohonan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="status_perizinan">Status Perizinan</label>
                            <select class="form-control @error('status_perizinan') is-invalid @enderror" id="status_perizinan" name="status_perizinan" required>
                                <option value="">Pilih Status</option>
                                <option value="Dalam proses analisis">Dalam proses analisis</option>
                                <option value="Kelengkapan dok">Kelengkapan dok</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Ditolak / dikembalikkan">Ditolak / dikembalikkan</option>
                            </select>
                            @error('status_perizinan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenis_output">Jenis Output</label>
                            <select class="form-control @error('jenis_output') is-invalid @enderror" id="jenis_output" name="jenis_output" required>
                                <option value="">Pilih Output</option>
                                <option value="Pencatatan">Pencatatan</option>
                                <option value="Penolakan">Penolakan</option>
                            </select>
                            @error('jenis_output')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_dokumen_lengkap">Tanggal Dokumen Lengkap</label>
                            <input type="date" class="form-control @error('tanggal_dok_lengkap') is-invalid @enderror" id="tanggal_dok_lengkap" name="tanggal_dok_lengkap">
                            @error('tanggal_dok_lengkap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="no_surat_pencatatan">Nomor Surat Pencatatan/Penolakan</label>
                            <input type="text" class="form-control @error('no_surat_pencatatan') is-invalid @enderror" id="no_surat_pencatatan" name="no_surat_pencatatan">
                            @error('no_surat_pencatatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_surat_pencatatan">Tanggal Surat Pencatatan/Penolakan</label>
                            <input type="date" class="form-control @error('tanggal_surat_pencatatan') is-invalid @enderror" id="tanggal_surat_pencatatan" name="tanggal_surat_pencatatan">
                            @error('tanggal_surat_pencatatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit">Dirkom</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection