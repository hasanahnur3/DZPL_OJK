@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Tambah Data LJK</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('daftarljk.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="jenis_industri" class="form-label">Jenis Industri</label>
                            <input type="text" class="form-control" id="jenis_industri" name="jenis_industri" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('daftarljk.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
