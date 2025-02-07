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
        <h2>Edit Agenda Rapat Pimpinan (Rapim)</h2>
        {{-- Form untuk Edit Agenda --}}
        <form action="{{ route('rapim.update', $rapim->id) }}" method="POST">
            @csrf
            @method('PUT')  <!-- Menambahkan metode PUT untuk update -->
            <div class="form-group">
                <label for="tanggal">Hari/Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $rapim->tanggal }}" required>
            </div>
            <div class="form-group">
                <label for="topik">Topik</label>
                <input type="text" name="topik" class="form-control" value="{{ $rapim->topik }}" required>
            </div>
            <div class="form-group">
                <label for="hasil">Hasil</label>
                <textarea name="hasil" class="form-control" required>{{ $rapim->hasil }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Agenda</button>
        </form>
    </div>


    <style>
    
    /* Pusatkan form di tengah layar */
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: auto;
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
