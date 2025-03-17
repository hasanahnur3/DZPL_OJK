@extends('layouts.app')

@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>

    <div class="form-container" style="overflow-x: auto;">
        <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Jadwal Rapat Pimpinan</h2>
        <table id="rapimTable" class="table table-striped"
            style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
            <thead>
                <tr>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Topik</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Hari/Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rapim as $item)
                    <tr>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: left; cursor: pointer;"
                            class="open-modal" data-id="{{ $item->id }}">
                            {{ $item->topik }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; text-align: left;">
                            {{ $item->tanggal }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Button Add Data -->
        <div class="button-container">
            @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
                <a href="{{ route('rapat-pimpinan.create') }}" class="btn btn-success">Add Data</a>
            @endif
        </div>
    </div>

    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Rapat Pimpinan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Detail akan diisi dengan JavaScript -->
                </div>
                <div class="modal-footer">
                    <!-- Button Edit -->
                    @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag']))
                        <a href="#" id="editButton" class="btn btn-primary">Edit</a>
                    @endif
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Inisialisasi DataTables
            $('#rapimTable').DataTable({
                "pageLength": 6
            });

            // Event delegation untuk klik pada elemen dengan class 'open-modal'
            $(document).on('click', '.open-modal', function () {
                const id = $(this).data('id');

                // Ajax request untuk mendapatkan detail
                $.ajax({
                    url: `/rapim/${id}`, // Pastikan route sesuai dengan backend
                    type: 'GET',
                    success: function (response) {
                        const userRole = '{{ Session::get('role') }}';

                        let hasilContent = '';
                        if (response.hasil) {
                            if (userRole === 'staf') {
                                hasilContent = '<p><strong>Hasil:</strong> Tidak diizinkan</p>';
                            } else {
                                hasilContent = `
                                        <p><strong>Hasil:</strong> <a href="${response.hasil}" target="_blank">Download Hasil</a></p>
                                    `;
                            }
                        } else {
                            hasilContent = '<p><strong>Hasil:</strong> Tidak ada file</p>';
                        }

                        const updatedInfo = response.updated_by
                            ? `<p><strong>Diperbarui Oleh:</strong> ${response.updated_by} pada ${response.updated_at || '-'}</p>`
                            : '<p><strong>Diperbarui Oleh:</strong> Tidak diketahui</p>';

                        // Update modal content
                        $('#modalContent').html(`
                                <p><strong>Topik:</strong> ${response.topik}</p>
                                <p><strong>Hari/Tanggal:</strong> ${response.tanggal}</p>
                                <p><strong>Bahan Materi:</strong> 
                                    ${response.bahan_materi ? `<a href="${response.bahan_materi}" target="_blank">Download Materi</a>` : 'Tidak ada file'}
                                </p>
                                ${hasilContent}
                                ${updatedInfo}
                                <p><strong>Dibuat Pada:</strong> ${response.created_at}</p>
                            `);

                        // Tampilkan tombol edit
                        $('#editButton').show();
                        $('#editButton').attr('href', `/rapim/${id}/edit`);

                        // Tampilkan modal
                        $('#detailModal').modal('show');
                    },
                    error: function () {
                        alert('Gagal mendapatkan detail rapim.');
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