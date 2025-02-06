@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Agenda Rapat Pimpinan (Rapim)</h2>

        {{-- Tampilkan pesan sukses --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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
@endsection
