@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 700px; margin: auto; padding: 2rem;   background-color:#FFFFFF;">

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
        <!-- Form untuk Menambah Data -->
        <div class="form-container">
        <h3 style="text-align:center;">Tambah Data Agenda PKK</h3>
            <form action="{{ route('penilaian-kemampuan.store') }}" method="POST"
                style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top:20px; align-item:center; width:100%;">
                @csrf

                <div style="display: flex; flex-direction: column; gap:5px;">

                    <div class="form-group">
                        <input type="date" name="hari_tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="time" name="waktu" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan" class="form-control"
                            required><br>
                    </div>
                    <div class="form-group">
                        <input type="text" name="peserta" placeholder="Peserta" class="form-control" required><br>
                    </div>
                    <div class="form-group">
                        <input type="text" name="jabatan" placeholder="Jabatan" class="form-control" required><br>
                    </div>
                    <div class="form-group">
                        <input type="text" name="zoom" placeholder="Zoom Link" class="form-control" required><br>
                    </div>
                </div>
                <div style="display: flex; flex-direction: column; gap:5px;">
                    <div class="form-group">
                        <input type="text" name="pic" placeholder="PIC" class="form-control" required><br>
                    </div>
                    <div class="form-group">
                        <input type="text" name="penguji" placeholder="Penguji" class="form-control" required><br>
                    </div>
                    <div class="form-group">
                        <input type="text" name="penguji1" placeholder="Penguji 1" id="penguji1" class="form-control"
                            required><br>
                    </div>
                    <div class="form-group">
                        <input type="text" name="penguji2" placeholder="Penguji 2" id="penguji2" class="form-control"><br>
                    </div>
                    <div class="form-group">
                        <textarea name="hasil" placeholder="Hasil" class="form-control" required></textarea><br>
                    </div>

                    <button type="submit" class="btn btn-primary"
                        style="background-color: #A91111; color: white; border: none; border-radius: 10px; cursor: pointer;">Tambah
                        Agenda</button>
                </div>
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
            margin-top: -10px;
            width: auto;
            background-color: white;
            display: flex;
            justify-content: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Vertikal center */
            align-items: center;
            /* Horizontal center */
            height: 100vh;
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