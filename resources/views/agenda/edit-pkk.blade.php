@extends('layouts.app')

@section('content')
    <h1>Edit PKK Agenda</h1>
    
    <!-- Menampilkan pesan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('pkk-agenda.update', $agenda->id) }}" method="POST">
        @csrf
        @method('PUT')
     <!-- Menandakan ini adalah update request -->
        
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
            <label for="hasil">Hasil</label>
            <textarea name="hasil" id="hasil" required class="form-control">{{ old('hasil', $agenda->hasil) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection
