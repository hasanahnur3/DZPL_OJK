@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Daftar Direksi Komisaris</div>

                <div class="card-body">
                    <form action="{{ route('dirkom.update', $dirkom->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Jenis Industri -->
                        <div class="form-group mb-3">
                            <label for="jenis_industri">Jenis Industri</label>
                            <select class="form-control @error('jenis_industri') is-invalid @enderror" id="jenis_industri" name="jenis_industri" required>
                                <option value="Manufaktur" {{ $dirkom->jenis_industri == 'Manufaktur' ? 'selected' : '' }}>Manufaktur</option>
                                <option value="Jasa" {{ $dirkom->jenis_industri == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                <option value="Perdagangan" {{ $dirkom->jenis_industri == 'Perdagangan' ? 'selected' : '' }}>Perdagangan</option>
                            </select>
                            @error('jenis_industri')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Nama Perusahaan -->
                        <div class="form-group mb-3">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan', $dirkom->nama_perusahaan) }}" required>
                            @error('nama_perusahaan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Nomor Surat Permohonan -->
                        <div class="form-group mb-3">
                            <label for="nomor_surat_permohonan">Nomor Surat Permohonan</label>
                            <input type="text" class="form-control @error('nomor_surat_permohonan') is-invalid @enderror" id="nomor_surat_permohonan" name="nomor_surat_permohonan" value="{{ old('nomor_surat_permohonan', $dirkom->nomor_surat_permohonan) }}" required>
                            @error('nomor_surat_permohonan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Tanggal Surat Permohonan -->
                        <div class="form-group mb-3">
                            <label for="tanggal_surat_permohonan">Tanggal Surat Permohonan</label>
                            <input type="date" class="form-control @error('tanggal_surat_permohonan') is-invalid @enderror" id="tanggal_surat_permohonan" name="tanggal_surat_permohonan" value="{{ old('tanggal_surat_permohonan', \Carbon\Carbon::parse($dirkom->tanggal_surat_permohonan)->format('Y-m-d')) }}" required>
                            @error('tanggal_surat_permohonan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Status Perizinan -->
                        <div class="form-group mb-3">
                            <label for="status_perizinan">Status Perizinan</label>
                            <select class="form-control @error('status_perizinan') is-invalid @enderror" id="status_perizinan" name="status_perizinan" required>
                                <option value="Dalam proses analisis" {{ $dirkom->status_perizinan == 'Dalam proses analisis' ? 'selected' : '' }}>Dalam proses analisis</option>
                                <option value="Kelengkapan dok" {{ $dirkom->status_perizinan == 'Kelengkapan dok' ? 'selected' : '' }}>Kelengkapan dok</option>
                                <option value="Selesai" {{ $dirkom->status_perizinan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Ditolak / dikembalikkan" {{ $dirkom->status_perizinan == 'Ditolak / dikembalikkan' ? 'selected' : '' }}>Ditolak / dikembalikkan</option>
                            </select>
                            @error('status_perizinan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Jenis Output -->
                        <div class="form-group mb-3">
                            <label for="jenis_output">Jenis Output</label>
                            <select class="form-control @error('jenis_output') is-invalid @enderror" id="jenis_output" name="jenis_output" required>
                                <option value="pencatatan" {{ $dirkom->jenis_output == 'pencatatan' ? 'selected' : '' }}>Pencatatan</option>
                                <option value="penolakan" {{ $dirkom->jenis_output == 'penolakan' ? 'selected' : '' }}>Penolakan</option>
                            </select>
                            @error('jenis_output')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Tanggal Dokumen Lengkap -->
                        <div class="form-group mb-3">
                            <label for="tanggal_dok_lengkap">Tanggal Dokumen Lengkap</label>
                            <input type="date" class="form-control @error('tanggal_dok_lengkap') is-invalid @enderror" id="tanggal_dok_lengkap" name="tanggal_dok_lengkap" value="{{ old('tanggal_dok_lengkap', $dirkom->tanggal_dok_lengkap ? \Carbon\Carbon::parse($dirkom->tanggal_dok_lengkap)->format('Y-m-d') : '') }}">
                            @error('tanggal_dok_lengkap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Nomor Surat Pencatatan -->
                        <div class="form-group mb-3">
                            <label for="no_surat_pencatatan">Nomor Surat Pencatatan</label>
                            <input type="text" class="form-control @error('no_surat_pencatatan') is-invalid @enderror" id="no_surat_pencatatan" name="no_surat_pencatatan" value="{{ old('no_surat_pencatatan', $dirkom->no_surat_pencatatan) }}">
                            @error('no_surat_pencatatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Tanggal Surat Pencatatan -->
                        <div class="form-group mb-3">
                            <label for="tanggal_surat_pencatatan">Tanggal Surat Pencatatan</label>
                            <input type="date" class="form-control @error('tanggal_surat_pencatatan') is-invalid @enderror" id="tanggal_surat_pencatatan" name="tanggal_surat_pencatatan" value="{{ old('tanggal_surat_pencatatan', $dirkom->tanggal_surat_pencatatan ? \Carbon\Carbon::parse($dirkom->tanggal_surat_pencatatan)->format('Y-m-d') : '') }}">
                            @error('tanggal_surat_pencatatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
