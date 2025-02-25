@extends('layouts.app')

@section('content')
    <div class="container"
        style="display: flex; justify-content: center; align-items: center; height:85vh; padding: 2rem; background-color: #FFFFFF;">

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
            <h3 style="text-align: center; margin-top:-10px; margin-bottom: -10px;">Tambah Forum Panel</h3>
            <form action="{{ route('forum-panel.store') }}" method="POST"
                style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top:20px; align-item:center; width:100%;">
                @csrf

                <div style="display: flex; flex-direction: column; margin-left:10px; margin-right:-10px;">
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
                </div>

                <div style="display: flex; flex-direction: column;">
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
                    <button type="submit" class="btn btn-primary"
                        style="background-color: #A91111; color: white; border: none; border-radius: 10px; cursor: pointer; margin-top:21px; height:35px;">Tambah
                        Forum Panel</button>

                </div>

            </form>
        </div>
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
            width: 600px;
            background-color: white;
            display: flex;
            justify-content: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex-direction: column;
            align-items: center;
            height: 70vh;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 10px;
            height: 50px;
            width: 95%;
        }

        .form-group {
            margin: 10px;
        }

        .btn-primary {
            color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #A91111;
            height: 40px;
            width: 90%;
            margin-left: 10px;
            margin-top: 10px;

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