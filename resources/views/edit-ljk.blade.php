@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f4f4f4;
    }

    .card {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        text-align: center;
        padding: 15px;
        font-size: 20px;
        font-weight: bold;
    }

    .form-label {
        font-weight: bold;
        color: #333;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 8px;
        font-weight: bold;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .icon {
        margin-right: 5px;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Data LJK</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('daftarljk.update', $ljk->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="jenis_industri" class="form-label">Jenis Industri</label>
                            <input type="text" class="form-control" id="jenis_industri" name="jenis_industri" value="{{ $ljk->jenis_industri }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ $ljk->nama_perusahaan }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('daftarljk.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left icon"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save icon"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
