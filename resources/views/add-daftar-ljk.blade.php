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

        <!-- Form untuk Menambah Data -->
        <div class="form-container">
            <h3 style="text-align:center;">Tambah Data LJK</h3>
            <form action="{{ route('daftarljk.store') }}" method="POST"
                style="gap: 20px; margin-top:20px; align-item:center; width:100%;">
                @csrf
                <div class="form-group">
                    <input type="text" name="jenis_industri" placeholder="Jenis Industri" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan" class="form-control"
                        required><br>
                </div>



                <button type="submit" class="btn btn-primary"
                    style="background-color: #A91111; color: white; border: none; border-radius: 10px; cursor: pointer; height:40px; margin-left:40px;">Simpan</button>
                <a href="{{ route('daftarljk.index') }}" class="btn btn-secondary"
                    style="border-radius: 10px; background-color: #adb5bd; padding: 12px 24px; color: white; text-align: center; text-decoration: none;">Batal</a>

            </form>
        </div>
    </div>

    <style>
        .form-container {
            width: 550px;
            background-color: white;
            display: flex;
            justify-content: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex-direction: column;
            align-items: center;
            height: 50vh;
            padding: 20px;
        }

        .form-group {
            margin: 10px;
            margin-left: 20px;
            display: flex;
            justify-content: center;
            /* Menjaga agar elemen berada di tengah */
            width: 90%;
            /* Memastikan form-group memanfaatkan ruang yang tersedia */
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 10px;
            height: 50px;
            width:90%;
            /* Menyesuaikan lebar input */
            display: flex;
            justify-content: center;
        }

        .btn-primary {
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #A91111;
            height: 30px;
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