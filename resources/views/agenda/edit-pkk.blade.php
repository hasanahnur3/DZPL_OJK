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

       
    <form action="{{ route('pkk-agenda.update', $agenda->id) }}" method="POST">
        @csrf
        @method('PUT')
     <!-- Menandakan ini adalah update request -->
     <h3 style="text-align:center;">Edit PKK Agenda</h3>
        <div class="form-group">
            <label for="hari_tanggal">Hari/Tanggal</label>
            <input type="date" name="hari_tanggal" id="hari_tanggal" value="{{ old('hari_tanggal', $agenda->hari_tanggal) }}" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="waktu">Waktu</label>
            <input type="time" name="waktu" id="waktu" value="{{ old('waktu', $agenda->waktu) }}" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="nama_perusahaan">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan', $agenda->nama_perusahaan) }}" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="peserta">Peserta</label>
            <input type="text" name="peserta" id="peserta" value="{{ old('peserta', $agenda->peserta) }}" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $agenda->jabatan) }}" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="zoom">Zoom</label>
            <input type="text" name="zoom" id="zoom" value="{{ old('zoom', $agenda->zoom) }}" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="pic">PIC</label>
            <input type="text" name="pic" id="pic" value="{{ old('pic', $agenda->pic) }}" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="penguji">Penguji</label>
            <input type="text" name="penguji" id="penguji" value="{{ old('penguji', $agenda->penguji) }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="penguji1">Penguji 1</label>
            <input type="text" name="penguji1" id="penguji1" value="{{ old('penguji1', $agenda->penguji1) }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="penguji2">Penguji 2</label>
            <input type="text" name="penguji2" id="penguji2" value="{{ old('penguji2', $agenda->penguji2) }}" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="hasil">Hasil</label>
            <textarea name="hasil" id="hasil" required class="form-control">{{ old('hasil', $agenda->hasil) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
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
