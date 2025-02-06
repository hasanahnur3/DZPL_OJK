@extends('layouts.app')

@section('content')
    <h1>Form PKK Agenda</h1>

    <!-- Form untuk Menambah Data -->
    <h2>Tambah Data Penilaian Kemampuan</h2>
    <form action="{{ route('penilaian-kemampuan.store') }}" method="POST">
        @csrf
        <input type="date" name="hari_tanggal" required><br>
        <input type="time" name="waktu" required><br>
        <input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan" required><br>
        <input type="text" name="peserta" placeholder="Peserta" required><br>
        <input type="text" name="jabatan" placeholder="Jabatan" required><br>
        <input type="text" name="zoom" placeholder="Zoom Link" required><br>
        <input type="text" name="pic" placeholder="PIC" required><br>
        <input type="text" name="penguji" placeholder="Penguji" required><br>
        <textarea name="hasil" placeholder="Hasil" required></textarea><br>
        <button type="submit">Tambah Agenda</button>
    </form>



    @endsection
