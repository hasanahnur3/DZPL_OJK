@extends('layouts.app')

@section('content')
    <div class="container"
        style="max-width: 700px; margin: auto; padding: 2rem;  border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color:white;">
        <h3 style="text-align: center;">Tambah Forum Panel</h3>
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
        <div class="form-container">
            <form action="{{ route('forum-panel.update', $forumPanel->id) }}" method="POST"
                style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top:20px; align-item:center; ">
                @csrf
                @method('PUT') <!-- Pastikan method PUT ada di sini -->
                <!-- Pastikan menggunakan method PUT untuk update -->
                <div style="display: flex; flex-direction: column; gap:5px;">
                    <div class="form-group">
                        <label>Nama Perusahaan:</label>
                        <input class="form-control" type="text" name="nama_perusahaan"
                            value="{{ old('nama_perusahaan', $forumPanel->nama_perusahaan) }}" required><br>
                    </div>

                    <div class="form-group">
                        <label>Hari Pelaksanaan:</label>
                        <input class="form-control" type="date" name="hari_pelaksanaan"
                            value="{{ old('hari_pelaksanaan', $forumPanel->hari_pelaksanaan) }}" required><br>
                    </div>

                    <div class="form-group">
                        <label>Waktu:</label>
                        <input class="form-control" type="time" name="waktu" value="{{ old('waktu', $forumPanel->waktu) }}"
                            required><br>
                    </div>

                    <div class="form-group">
                        <label>Tempat Pelaksanaan:</label>
                        <input class="form-control" type="text" name="tempat_pelaksanaan"
                            value="{{ old('tempat_pelaksanaan', $forumPanel->tempat_pelaksanaan) }}" required><br>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap:5px;">
                    <div class="form-group">
                        <label>Kriteria:</label>
                        <textarea class="form-control" name="kriteria"
                            required>{{ old('kriteria', $forumPanel->kriteria) }}</textarea><br>
                    </div>

                    <div class="form-group">
                        <label>Jenis Industri:</label>
                        <input class="form-control" type="text" name="jenis_industri"
                            value="{{ old('jenis_industri', $forumPanel->jenis_industri) }}" required><br>
                    </div>

                    <div class="form-group">
                        <label>Hasil:</label>
                        <textarea class="form-control" name="hasil"
                            required>{{ old('hasil', $forumPanel->hasil) }}</textarea><br>
                    </div>


                    <button type="submit" class="btn btn-primary"
                        style="background-color: #A91111; color: white; border: none; border-radius: 10px; cursor: pointer; height: 35px; margin-top:21px;">Update
                        Forum Panel</button>
                </div>
            </form>
        </div>

        <style>
            .form-container {
                margin-top: -30px;
                width: auto;
                padding: 2rem;
                background-color: white;
                display: flex;
                justify-content: center;
            }

            /* Styling untuk frame form */


            .form-control {
                border: 1px solid #ddd;
                border-radius: 10px;
                height: 50px;
                width: 100%;
            }

            .form-group {
                margin: 10px;
            }

            .btn-primary {
                color: #ffffff;
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