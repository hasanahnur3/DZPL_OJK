@extends('layouts.app')

@section('content')

<div class="form-container">
<form action="{{ route('forum-panel.update', $forumPanel->id) }}" method="POST">
    @csrf
    @method('PUT')  <!-- Pastikan method PUT ada di sini -->
 <!-- Pastikan menggunakan method PUT untuk update -->
    <div class="form-group">
    <label>Nama Perusahaan:</label>
    <input class="form-control"type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $forumPanel->nama_perusahaan) }}" required><br>
    </div>

    <div class="form-group">
    <label>Hari Pelaksanaan:</label>
    <input class="form-control"type="date" name="hari_pelaksanaan" value="{{ old('hari_pelaksanaan', $forumPanel->hari_pelaksanaan) }}" required><br>
    </div>

    <div class="form-group">
    <label>Waktu:</label>
    <input class="form-control"type="time" name="waktu" value="{{ old('waktu', $forumPanel->waktu) }}" required><br>
    </div>

    <div class="form-group">
    <label>Tempat Pelaksanaan:</label>
    <input class="form-control"type="text" name="tempat_pelaksanaan" value="{{ old('tempat_pelaksanaan', $forumPanel->tempat_pelaksanaan) }}" required><br>
    </div>

    <div class="form-group">
    <label>Kriteria:</label>
    <textarea class="form-control"name="kriteria" required>{{ old('kriteria', $forumPanel->kriteria) }}</textarea><br>
    </div>

    <div class="form-group">
    <label>Jenis Industri:</label>
    <input class="form-control"type="text" name="jenis_industri" value="{{ old('jenis_industri', $forumPanel->jenis_industri) }}" required><br>
    </div>

    <div class="form-group">
    <label>Hasil:</label>
    <textarea class="form-control"name="hasil" required>{{ old('hasil', $forumPanel->hasil) }}</textarea><br>
    </div>


    <button type="submit" class="btn btn-primary">Update Forum Panel</button>
</form>
</div>

<style>
        /* Pusatkan form di tengah layar */
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            padding: 20px;
            /* Tambahkan padding jika dibutuhkan */
            width: 100%;
            /* Pastikan memenuhi layar */
        }

        /* Styling untuk frame form */
        form {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            /* Lebar maksimal diperbesar */
        }

        .form-control {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            height: 30px;
            width: 100%;
        }

        .form-group {
            margin: 10px;
        }

        .btn-primary {
            color:#ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #A91111;
            height: 30px;
            width: 100%;
            /* Tombol melebar */
        }
    </style>
@endsection
