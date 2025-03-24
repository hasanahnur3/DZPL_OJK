@extends('layouts.app')

@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div class="form-container" style="overflow-x: auto;">
        <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Jadwal Agenda PKK</h2>
        <table id="pkkTable" class="table table-striped"
            style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
            <thead>
                <tr>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Hari/Tanggal</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Waktu</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nama Perusahaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agendas as $agenda)
                    <tr>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $agenda->id }}">
                            {{ $agenda->hari_tanggal }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $agenda->id }}">
                            {{ $agenda->waktu }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $agenda->id }}">
                            {{ $agenda->nama_perusahaan }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Button Add Data -->
        <div class="button-container">
            @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag', 'kadep', 'kepala_eksekutif']))
                <a href="{{ route('penilaian-kemampuan.create') }}" class="btn btn-success">Add Data</a>
            @endif
        </div>
    </div>

    <!-- Modal untuk Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Agenda PKK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Detail akan diisi dengan JavaScript -->
                </div>
                <div class="modal-footer">
                    <!-- Button Edit -->
                    <!-- Button Edit -->
                    @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag', 'kadep', 'kepala_eksekutif']))
                        <a href="#" id="editButton" class="btn btn-primary">Edit</a>
                    @endif
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Inisialisasi DataTables
            $('#pkkTable').DataTable({
                "pageLength": 6
            });

            // Event untuk membuka modal
            $(document).on('click', '.open-modal', function () {
                const id = $(this).data('id');

                // AJAX request untuk mendapatkan detail
                $.ajax({
                    url: `/pkk-agenda/${id}`, // Sesuaikan dengan route backend
                    type: 'GET',
                    success: function (response) {
                        // Isi modal dengan detail data
                        $('#modalContent').html(`
                                    <table style=" border-collapse: collapse;">

                                        <tr>
                                            <td style="padding: 8px;"><strong>Hari/Tanggal</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.hari_tanggal}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Waktu</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;"> ${response.waktu}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Nama Perusahaan</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.nama_perusahaan}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>PIC</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.pic}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Zoom</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.zoom}</td>
                                        </tr>
                                       <tr>
                                            <td style="padding: 8px;"><strong>Peserta</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.peserta}</td>
                                        </tr>
                                       <tr>
                                            <td style="padding: 8px;"><strong>Penguji 1</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.penguji}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Penguji 2</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.penguji1}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Penguji 3</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.penguji2}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Hasil</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.hasil ? `<a href="${response.hasil}" target="_blank">Download Hasil</a>` : 'Tidak tersedia'}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Dibuat Pada</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.created_at}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Diperbarui Oleh</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.updated_by} pada ${response.updated_at || '-'}</td>
                                        </tr>
                                    </table>
                                `);

                        // Set href button Edit
                        $('#editButton').attr('href', `/agenda-pkk/${id}/edit`);

                        // Tampilkan modal
                        $('#detailModal').modal('show');
                    },
                    error: function () {
                        alert('Gagal mendapatkan detail agenda.');
                    }
                });
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

        .table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .table tr:hover {
            background-color: #f0f0f0;
        }

        .btn-close {
            color: black;
            background: none;
            border: none;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-close:hover {
            color: red;
        }

        .modal-footer .btn {
            margin-left: 5px;
        }

        .modal-content {
            max-width: 550px;
            margin: auto;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
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

        .btn-close {
            color: black;
            background: none;
            border: none;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-close:hover {
            color: red;
        }
    </style>

@endsection