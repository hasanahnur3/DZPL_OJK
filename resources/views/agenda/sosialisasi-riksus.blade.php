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

    <!-- Form untuk tambah agenda -->
    <div class="form-container" >
    <form action="{{ route('sosialisasi-riksus.store') }}" method="POST">
        @csrf
        <h3>Agenda Sosialisasi Riksus</h3>
        <div class="form-group">
            <label for="judul_sosialisasi">Judul Sosialisasi</label>
            <input type="text" name="judul_sosialisasi" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="hari_tanggal">Hari/Tanggal</label>
            <input type="date" name="hari_tanggal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tempat">Tempat</label>
            <input type="text" name="tempat" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="keterangan_peserta">Keterangan Peserta</label>
            <textarea name="keterangan_peserta" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="kesimpulan">Kesimpulan</label>
            <textarea name="kesimpulan" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="background-color: #A91111; color: white; border: none; border-radius: 10px; cursor: pointer;">Tambah Agenda</button>
    </form>
    </div>

</div>

<style>
    /* Pusatkan form di tengah layar */
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

    /* Styling untuk frame form */
    
    .form-control{
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
        height: 30px;
        width: 100%;
    }
    .form-group{
        margin: 10px;

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
    }
        /* Styling untuk tombol */
        .btn-primary {
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #A91111;
        height: 30px;
        width: 100%; /* Tombol melebar */
    }
    h3 {
        text-align: center; /* Rata tengah teks */
        margin-bottom: 20px;
    }
</style>
@endsection
