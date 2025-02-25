@extends('layouts.app')

@section('content')
    <div class="container"
        style="display: flex; justify-content: center; align-items: center; height:100vh; padding: 2rem; background-color: #FFFFFF;">


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
        <h3 style="text-align:center; margin-top:-10px; margin-bottom: -10px;">Edit Agenda PKK</h3>
            <form action="{{ route('pkk-agenda.update', $agenda->id) }}" method="POST"
                style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top:20px; align-item:center; width:100%;">
                @csrf
                @method('PUT')
                <!-- Menandakan ini adalah update request -->
                <div style="display: flex; flex-direction: column; margin-left:10px; margin-right:-10px;">
                    <div class="form-group">
                        <label for="hari_tanggal">Hari/Tanggal</label>
                        <input type="date" name="hari_tanggal" id="hari_tanggal"
                            value="{{ old('hari_tanggal', $agenda->hari_tanggal) }}" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="waktu">Waktu</label>
                        <input type="time" name="waktu" id="waktu" value="{{ old('waktu', $agenda->waktu) }}" required
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                            value="{{ old('nama_perusahaan', $agenda->nama_perusahaan) }}" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="peserta">Peserta</label>
                        <input type="text" name="peserta" id="peserta" value="{{ old('peserta', $agenda->peserta) }}"
                            required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $agenda->jabatan) }}"
                            required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="zoom">Zoom</label>
                        <input type="text" name="zoom" id="zoom" value="{{ old('zoom', $agenda->zoom) }}" required
                            class="form-control">
                    </div>
                </div>

                <div style="display: flex; flex-direction: column;">
                    <div class="form-group">
                        <label for="pic">PIC</label>
                        <input type="text" name="pic" id="pic" value="{{ old('pic', $agenda->pic) }}" required
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="penguji">Penguji</label>
                        <input type="text" name="penguji" id="penguji" value="{{ old('penguji', $agenda->penguji) }}"
                            required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="penguji1">Penguji 1</label>
                        <input type="text" name="penguji1" id="penguji1" value="{{ old('penguji1', $agenda->penguji1) }}"
                            required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="penguji2">Penguji 2</label>
                        <input type="text" name="penguji2" id="penguji2" value="{{ old('penguji2', $agenda->penguji2) }}"
                            required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="hasil">Hasil</label>
                        <textarea name="hasil" id="hasil" required
                            class="form-control">{{ old('hasil', $agenda->hasil) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary"
                        style="background-color: #A91111; color: white; border: none; border-radius: 10px; cursor: pointer;">Update</button>
                </div>
            </form>
        </div>
    </div>


    <style>
        .form-container {
            width: 700px;
            background-color: white;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Styling untuk frame form */

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
            margin-left: 20px;
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