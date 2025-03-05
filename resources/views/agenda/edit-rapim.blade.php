@extends('layouts.app')

@section('content')

    <div class="container"
        style="display: flex; justify-content: center; align-items: center; height: 95vh; background-color: #FFFFFF; ">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Seleksi form
                const form = document.querySelector('form');

                // Tambahkan event listener ke form
                form.addEventListener('submit', function (event) {
                    event.preventDefault(); // Mencegah pengiriman form secara default

                    // Tampilkan SweetAlert2
                    Swal.fire({
                        title: 'Data berhasil diupdate!',
                        text: 'Data Anda telah berhasil dikirim ke server.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim form ke server jika tombol "OK" diklik
                            form.submit();
                        }
                    });
                });
            });
        </script>
        {{-- Form Edit Agenda --}}
        <div class="form-container">
            <form action="{{ route('rapim.update', $rapim->id) }}" method="POST" enctype="multipart/form-data"
                style="width: 100%;">
                @csrf
                @method('PUT') <!-- Menambahkan metode PUT untuk update -->
                <h3>Edit Agenda Rapat Pimpinan (Rapim)</h3>
                <div class="form-group">
                    <label for="tanggal">Hari/Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $rapim->tanggal }}" required>
                </div>
                <div class="form-group">
                    <label for="topik">Topik</label>
                    <input type="text" name="topik" class="form-control" value="{{ $rapim->topik }}" required>
                </div>
                <div class="form-group">
                    <label for="bahan_materi">Bahan Materi</label>
                    <input type="file" name="bahan_materi" class="form-control" accept=".pdf, .ppt, .pptx">
                    @if ($rapim->bahan_materi)
                        <small>File saat ini: <a href="{{ asset('storage/' . $rapim->bahan_materi) }}" target="_blank">Lihat
                                File</a></small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="hasil">Hasil</label>
                    <input type="file" name="hasil" class="form-control" accept=".pdf, .ppt, .pptx">
                    @if ($rapim->hasil)
                        <small>File saat ini: <a href="{{ asset('storage/' . $rapim->hasil) }}" target="_blank">Lihat
                                File</a></small>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary"
                    style="background-color: #A91111; color: white; border: none; border-radius: 10px; cursor: pointer; margin-left:5px;">
                    Perbarui Agenda
                </button>
            </form>
        </div>
    </div>

    <style>
        html,
        body {
            height: 100%;
            overflow: hidden;
            /* Menonaktifkan scroll */
            margin: 0;
        }

        .form-container {
            max-width: 500px;
            width: 100%;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
            display: flex;
            justify-content: center;
        }

        /* Styling untuk frame form */
        h3 {
            text-align: center;
            /* Rata tengah teks */
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #ffc107;
            color: black;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #e0a800;
        }

        /* Styling untuk tombol */
        .btn-primary {
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #A91111;
            height: 30px;
            width: 100%;
            /* Tombol melebar */
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 10px;
            height: 50px;
            width: 100%;
        }

        .form-group {
            margin: 10px;
        }
    </style>
@endsection