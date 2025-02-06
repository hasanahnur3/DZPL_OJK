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
    <h2 style="margin-bottom:10px;">Form PKK Agenda</h2>

    <!-- Form untuk Menambah Data -->
    <div class="form-container">
    <form action="{{ route('penilaian-kemampuan.store') }}" method="POST">
        @csrf
        <h3 style="text-align:center;">Tambah Data Penilaian Kemampuan</h3>
        <div class="form-group">
        <input type="date" name="hari_tanggal" class="form-control"  required>
        </div>
        <div class="form-group">
        <input type="time" name="waktu"class="form-control"  required>
        </div>
        <div class="form-group">
        <input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan" class="form-control" required><br>
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
        <div class="form-group">
        <input type="text" name="pic" placeholder="PIC" class="form-control" required><br>
        </div>
        <div class="form-group">
        <input type="text" name="penguji" placeholder="Penguji" class="form-control" required><br>
        </div>
        <div class="form-group">
            <input type="text" name="penguji1" placeholder="Penguji 1" id="penguji1" class="form-control" required><br>
        </div>
        <div class="form-group">
            <input type="text" name="penguji2" placeholder="Penguji 2" id="penguji2" class="form-control"><br>
        </div>        
        <div class="form-group">
        <textarea name="hasil" placeholder="Hasil" class="form-control" required></textarea><br>
        </div>

        <button type="submit" class="btn btn-primary" style="color:white;">Tambah Agenda</button>
    </form>
    </div>
    </div>

    <style>
            /* Pusatkan form di tengah layar */
    .form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
    padding: 20px; /* Tambahkan padding jika dibutuhkan */
    width: 100%; /* Pastikan memenuhi layar */
}

    /* Styling untuk frame form */
    form {
    background-color: #ffffff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px; /* Lebar maksimal diperbesar */
}
.form-control{
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
        height: 30px;
        width: 100%;
    }
    .form-group{
        margin: 10px;
    }
    .btn-primary {
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #A91111;
        height: 30px;
        width: 100%; /* Tombol melebar */
    }
    </style>



    @endsection
