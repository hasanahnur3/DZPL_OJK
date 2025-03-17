@extends('layouts.app')

@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>

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
            @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
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
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Detail akan diisi dengan JavaScript -->
                </div>
                <div class="modal-footer">
                    <!-- Button Edit -->
                    <a href="#" id="editButton" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
                                <p><strong>Hari/Tanggal:</strong> ${response.hari_tanggal}</p>
                                <p><strong>Waktu:</strong> ${response.waktu}</p>
                                <p><strong>Nama Perusahaan:</strong> ${response.nama_perusahaan}</p>
                                <p><strong>PIC:</strong> ${response.pic}</p>
                                <p><strong>Zoom:</strong> ${response.zoom}</p>
                                <p><strong>Peserta:</strong> ${response.peserta}</p>
                                <p><strong>Penguji 1:</strong> ${response.penguji}</p>
                                <p><strong>Penguji 2:</strong> ${response.penguji1}</p>
                                <p><strong>Penguji 3:</strong> ${response.penguji2}</p>
                                <p><strong>Hasil:</strong> ${response.hasil ? `<a href="${response.hasil}" target="_blank">Download Hasil</a>` : 'Tidak tersedia'}</p>
                                <p><strong>Dibuat Pada:</strong> ${response.created_at}</p>
                                <p><strong>Diperbarui Oleh:</strong> ${response.updated_by} pada ${response.updated_at || '-'}</p>
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
    </style>

@endsection