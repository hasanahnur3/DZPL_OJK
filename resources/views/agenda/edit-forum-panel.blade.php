@extends('layouts.app')

@section('content')
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
<form action="{{ route('forum-panel.update', $forumPanel->id) }}" method="POST">
    @csrf
    @method('PUT')  <!-- Pastikan method PUT ada di sini -->
 <!-- Pastikan menggunakan method PUT untuk update -->
 <h3 style="text-align:center;">Edit Agenda Forum Panel</h3>
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
            height: 90vh;
            padding: 20px;
            width: 100%;
        } */

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
