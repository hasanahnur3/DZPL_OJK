@extends('layouts.app')

@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>

    <div class="form-container" style="overflow-x: auto;">
        <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Jadwal Sosialisasi Riksus</h2>
        <table id="riksusTable" class="table table-striped"
            style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
            <thead>
                <tr>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Hari</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Tempat</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Judul Sosialisasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $item)
                    <tr>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $item->id }}">
                            {{ $item->hari_tanggal }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $item->id }}">
                            {{ $item->tempat }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $item->id }}">
                            {{ $item->judul_sosialisasi }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Button Add Data -->
        <div class="button-container">
            @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
                <a href="{{ route('sosialisasi-riksus.index') }}" class="btn btn-success">Add Data</a>
            @endif
        </div>
    </div>

    <!-- Modal untuk Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Sosialisasi Riksus</h5>
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
            $('#riksusTable').DataTable({
                "pageLength": 6
            });

            // Event untuk membuka modal
            $(document).on('click', '.open-modal', function () {
                const id = $(this).data('id');

                // AJAX request untuk mendapatkan detail
                $.ajax({
                    url: `/sosialisasi-riksus/${id}`, // Sesuaikan dengan route backend
                    type: 'GET',
                    success: function (response) {
                        // Isi modal dengan detail data
                        $('#modalContent').html(`
                                <p><strong>Judul Sosialisasi:</strong> ${response.judul_sosialisasi}</p>
                                <p><strong>Hari/Tanggal:</strong> ${response.hari_tanggal}</p>
                                <p><strong>Tempat:</strong> ${response.tempat}</p>
                                <p><strong>Keterangan Peserta:</strong> ${response.keterangan_peserta}</p>
                                <p><strong>Kesimpulan:</strong> ${response.kesimpulan}</p>
                                <p><strong>Dibuat Pada:</strong> ${response.created_at}</p>
                                <p><strong>Diperbarui Oleh:</strong> ${response.updated_by} pada ${response.updated_at || '-'}</p>
                            `);

                        // Set href button Edit
                        $('#editButton').attr('href', `/sosialisasi-riksus/${id}/edit`);

                        // Tampilkan modal
                        $('#detailModal').modal('show');
                    },
                    error: function () {
                        alert('Gagal mendapatkan detail sosialisasi.');
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