@extends('layouts.app')

@section('content')
    <div class="container" 
        style="max-width: 600px; margin: auto; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color:white;">
        <h3 style="text-align:center;">Edit Data LJK</h3>
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

        <!-- Form untuk Mengedit Data -->
        <div class="form-container">
            <form action="{{ route('daftarljk.update', $ljk->id) }}" method="POST"
                style="gap: 20px; margin-top:20px; align-items:center; width:100%;">
                @csrf

                    <div class="form-group">
                        <input type="text" name="jenis_industri" value="{{ $ljk->jenis_industri }}" placeholder="Jenis Industri" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="nama_perusahaan" value="{{ $ljk->nama_perusahaan }}" placeholder="Nama Perusahaan" class="form-control" required><br>
                    </div>
                
                    <button type="submit" class="btn btn-primary"
                        style="background-color: #A91111; color: white; border: none; border-radius: 10px; cursor: pointer; height:40px;">Simpan Perubahan</button>
                    <a href="{{ route('daftarljk.index') }}" class="btn btn-secondary"
                        style="border-radius: 10px; background-color: #adb5bd; padding: 12px 24px; color: white; text-align: center; text-decoration: none;">Batal</a>
                
            </form>
        </div>
    </div>

    <style>
        .form-container {
            margin-top: -10px;
            width: auto;
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
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #A91111;
            height: 40px;
            width: 60%;
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
            margin: 20px;
        }

        .btn:hover {
            background-color: #e0a800;
        }
    </style>
@endsection
