@extends('layouts.app')

@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">


    <div class="form-container" style="overflow-x: auto;">
        <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Jadwal Rapat Pimpinan</h2>
        <table id="rapatTable" class="table"
            style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
            <thead style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                <tr>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">No</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6; ">Hari/Tanggal
                    </th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6; ">Topik</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6; ">Bahan Materi
                    </th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6; ">Hasil</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6; ">Created At</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6; ">Updated At</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6; ">Last Updated By</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center; ">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rapim as $index => $item)
                    <tr>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">{{ $index + 1 }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">{{ $item->tanggal }}</td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">{{ $item->topik }}</td>
                        <td>
                            @if ($item->bahan_materi)
                                <a href="{{ Storage::url($item->bahan_materi) }}" target="_blank">Download Bahan Materi</a>
                            @else
                                Tidak ada file
                            @endif
                        </td>
                        <td>
                            @if ($item->hasil)
                                <a href="{{ Storage::url($item->hasil) }}" target="_blank">Download Hasil</a>
                            @else
                                Tidak ada file
                            @endif
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                            {{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                            {{ $item->updated_at ? $item->updated_at->format('d-m-Y H:i') : '-' }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                            {{ $item->updated_by ?? 'Tidak diketahui' }} <!-- Menampilkan siapa yang mengupdate -->
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: center;">
                            @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
                                <a href="{{ route('rapim.edit', $item->id) }}"
                                    style="background-color: #007bff; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px;">Edit</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="button-container">
            @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
                <a href="{{ route('rapat-pimpinan.create') }}" class="btn btn-success">Add Data</a>
            @endif
        </div>
    </div>



    <script>
        $(document).ready(function () {
            $('#rapatTable').DataTable({
                "pageLength": 6 // Menampilkan 6 entri per halaman
            });
        });
    </script>

    <style>
        .form-container {
            max-width: 94%;
            width: 100%;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
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

        .btn-success {
            background-color: #28a745;
            border: 2px solid #28a745;
            border-radius: 8px;
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: white;
            text-align: center;
            text-decoration: none;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-warning {
            background-color: #ffc107;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .table {
            width: 100%;
            /* border-collapse: collapse;
            table-layout: fixed;
            /* Ini kunci untuk membuat kolom compact */
            margin-top: 20px; */
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            overflow: hidden;
            /* Mencegah teks meluap dari kolom */
            text-overflow: ellipsis;
            /* Menambahkan ellipsis (...) jika teks terlalu panjang */
            white-space: nowrap;
            /* Mencegah teks wrap ke baris baru */
        }

        .table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .table tr:hover {
            background-color: #f0f0f0;
        }
    </style>

@endsection