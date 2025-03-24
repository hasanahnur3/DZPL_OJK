@extends('layouts.app')

@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>

    <div class="form-container" style="overflow-x: auto;">
        <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Daftar TKA</h2>
        <table id="dirkomTable" class="table table-striped"
            style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
            <thead>
                <tr>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jenis Indsutri</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nama Perusahaan</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Status Perizinan</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jenis Output</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dirkoms as $dirkom)
                    <tr>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $dirkom->id }}">
                            {{ $dirkom->jenis_industri }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $dirkom->id }}">
                            {{ $dirkom->nama_perusahaan }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $dirkom->id }}">
                            {{ $dirkom->status_perizinan }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $dirkom->id }}">
                            {{ $dirkom->jenis_output }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Button Add Data -->
        <div class="button-container">
            <x-modal-filter :action="route('dirkom')" :startDate="$startDate" :endDate="$endDate" />
            @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag', 'kadep', 'kepala_eksekutif']))
                <a href="{{ route('dirkom.create') }}" class="btn btn-success">Add Data</a>
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
                    <!-- Button Edit -->
                    @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag', 'kadep', 'kepala_eksekutif']))
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
            $('#dirkomTable').DataTable({
                "pageLength": 6
            });

            // Fungsi menghitung SLA
            function calculateSLA(startDate, status_perizinan) {
                if (!startDate || (status_perizinan && status_perizinan.trim().toLowerCase() === 'selesai')) {
                    return '-';
                }

                const today = new Date();
                const dokDate = new Date(startDate);

                const calculateWorkDays = (start, end) => {
                    let count = 0;
                    while (start <= end) {
                        const day = start.getDay();
                        if (day !== 0 && day !== 6) count++; // Hitung hanya hari kerja
                        start.setDate(start.getDate() + 1);
                    }
                    return count;
                };

                const daysPassed = calculateWorkDays(new Date(dokDate), today);
                const sla = 20 - daysPassed;
                const color = sla < 0 ? 'red' : sla <= 5 ? 'orange' : 'green';

                return `<span style="color: ${color}; font-weight: bold;">${sla}</span>`;
            }

            // Event untuk membuka modal
            $(document).on('click', '.open-modal', function () {
                const id = $(this).data('id');

                // AJAX request untuk mendapatkan detail
                $.ajax({
                    url: `/dirkom/${id}`, // Sesuaikan dengan route backend
                    type: 'GET',
                    success: function (response) {
                        // Isi modal dengan detail data
                        $('#modalContent').html(`
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                                    <table style="border-collapse: collapse;">
                                        <tr>
                                            <td style="padding: 8px;"><strong>Jenis Industri</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.jenis_industri}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Nama Perusahaan</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.nama_perusahaan}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Nomor Surat Permohonan</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.nomor_surat_permohonan}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Tanggal Surat Permohonan</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.tanggal_surat_permohonan}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Status Perizinan</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.status_perizinan}</td>
                                        </tr>
                                        </table>
                                        <table style="border-collapse: collapse;">
                                        <tr>
                                            <td style="padding: 8px;"><strong>Jenis Output</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.jenis_output}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Tanggal Dokumen Lengkap</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.status_perizinan == 'Selesai' ? '-' : response.tanggal_dok_lengkap}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Nomor Surat Tanggapan</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.no_surat_pencatatan}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Tanggal Surat Tanggapan</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.tanggal_surat_pencatatan}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>SLA</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${calculateSLA(response.tanggal_dok_lengkap, response.status_perizinan)}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Dibuat Pada</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.created_at ? new Date(response.created_at).toLocaleString('id-ID') : '-'}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px;"><strong>Diperbarui Oleh</strong></td>
                                            <td>:</td>
                                            <td style="padding: 8px;">${response.updated_by || 'Tidak diketahui'} pada ${response.updated_at ? new Date(response.updated_at).toLocaleString('id-ID') : '-'}</td>
                                        </tr>
                                    </table>
                                </div>
                            `);

                        // Set href button Edit
                        $('#editButton').attr('href', `/dirkom/${id}/edit`);

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

        .modal-content {
            max-width: 100%;
            margin: auto;
        }
    </style>

@endsection