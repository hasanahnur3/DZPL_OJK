@extends('layouts.app')

@section('content')
<div>
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
                    title: 'Data berhasil disimpan!',
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

    <!-- Form untuk menambah forum panel -->
    <div class="form-container">
        <form action="{{ route('forum-panel.store') }}" method="POST">
            @csrf
            <h3>Tambah Forum Panel</h3>
            <div class="form-group">
                <label>Nama Perusahaan:</label>
                <input type="text" name="nama_perusahaan" class="form-control" required><br>
            </div>

            <div class="form-group">
                <label>Hari Pelaksanaan:</label>
                <input type="date" name="hari_pelaksanaan" class="form-control" required><br>
            </div>

            <div class="form-group">
                <label>Waktu:</label>
                <input type="time" name="waktu" class="form-control" required><br>
            </div>

            <div class="form-group">
                <label>Tempat Pelaksanaan:</label>
                <input type="text" name="tempat_pelaksanaan" class="form-control" required><br>
            </div>

            <div class="form-group">
                <label>Kriteria:</label>
                <textarea name="kriteria" class="form-control" required></textarea><br>
            </div>

            <div class="form-group">
                <label>Jenis Industri:</label>
                <input type="text" name="jenis_industri" class="form-control" required><br>
            </div>

            <div class="form-group">
                <label>Hasil:</label>
                <textarea name="hasil" class="form-control" required></textarea><br>
            </div>

            <button type="submit" class="btn btn-primary" style="background-color: #A91111; color: white; border: none; border-radius: 10px; cursor: pointer;">Tambah Forum Panel</button>
        </form>
    </div>
    </div>
    </div>

    <style>
        .form-container {
        max-width: 100%;
        width: 100%;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: white;
        display: flex;
        justify-content: center;
    }
        /* .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            padding: 20px;
            width: 100%;
        } */

        /* Styling untuk frame form */
        

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
    </style>

    @endsection