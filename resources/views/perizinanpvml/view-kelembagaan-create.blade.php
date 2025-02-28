@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Kelembagaan 2</h2>

    <form action="{{ route('kelembagaan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Lembaga</label>
            <input type="text" name="nama_lembaga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kontak</label>
            <input type="text" name="kontak" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
