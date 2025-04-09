@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>>

    <div class="form-container" style="overflow-x: auto;">
        <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Daftar Pengajuan Kelembagaan</h2>
        <table id="kelembagaanTable" class="table table-striped"
            style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
            <thead>
                <tr>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jenis Indsutri</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nama Perusahaan</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Detail Izin</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">SLA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelembagaan as $index => $item)
                    <tr>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $item->id }}">
                            {{ $item->jenis_industri }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $item->id }}">
                            {{ $item->nama_perusahaan }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $item->id }}">
                            {{ $item->detail_izin }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6;">
                            @if (is_numeric($item->sla_remaining))
                                <span style="color: {{ $item->sla_remaining < 0 ? 'red' : 'green' }}">
                                    {{ $item->sla_remaining }}
                                </span>
                            @else
                                {{ $item->sla_remaining }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Button Add Data -->
        <div class="button-container mb-3">
            <x-modal-filter :action="route('kelembagaan.index')" :startDate="$startDate" :endDate="$endDate" />
            @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag', 'kadep', 'kepala_eksekutif']))
                <a href="{{ route('kelembagaan.create') }}" class="btn btn-success">Add Data</a>
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
            $('#kelembagaanTable').DataTable({
                "pageLength": 6
            });

            // Event untuk membuka modal
            $(document).on('click', '.open-modal', function () {
                const id = $(this).data('id');

                // AJAX request untuk mendapatkan detail
                $.ajax({
                    url: `/kelembagaan/${id}`, // Sesuaikan dengan route backend
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
                                                                    <td style="padding: 8px;"><strong>Detail Izin</strong></td>
                                                                    <td>:</td>
                                                                    <td style="padding: 8px;">${response.detail_izin || '-'}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 8px;"><strong>SLA</strong></td>
                                                                    <td>:</td>
                                                                    <td style="padding: 8px;">
                                                                        ${isNaN(response.sla_remaining)
                                ? response.sla_remaining
                                : `<span style="color: ${response.sla_remaining < 0 ? 'red' : 'green'};">
                                                                                ${response.sla_remaining}
                                                                            </span>`}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 8px;"><strong>Status</strong></td>
                                                                    <td>:</td>
                                                                    <td style="padding: 8px;">${response.status}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 8px;"><strong>Nomor Surat Permohonan</strong></td>
                                                                    <td>:</td>
                                                                    <td style="padding: 8px;">${response.nomor_surat_permohonan || '-'}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 8px;"><strong>Tanggal Surat Permohonan</strong></td>
                                                                    <td>:</td>
                                                                    <td style="padding: 8px;">${response.tanggal_surat_permohonan ? new Date(response.tanggal_surat_permohonan).toLocaleDateString('id-ID') : '-'}</td>
                                                                </tr>

                                                            </table>
                                                            <table style="border-collapse: collapse;">
                                                                <tr>
                                                                    <td style="padding: 8px;"><strong>Tanggal Pengajuan Sistem</strong></td>
                                                                    <td>:</td>
                                                                    <td style="padding: 8px;">${response.tanggal_pengajuan_sistem ? new Date(response.tanggal_pengajuan_sistem).toLocaleDateString('id-ID') : '-'}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="padding: 8px;"><strong>Tanggal Dokumen Lengkap</strong></td>
                                                                    <td>:</td>
                                                                    <td style="padding: 8px;">${response.tanggal_dokumen_lengkap ? new Date(response.tanggal_dokumen_lengkap).toLocaleDateString('id-ID') : '-'}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 8px;"><strong>Tanggal Selesai Analisis</strong></td>
                                                                    <td>:</td>
                                                                    <td style="padding: 8px;">${response.tanggal_selesai_analisis ? new Date(response.tanggal_selesai_analisis).toLocaleDateString('id-ID') : '-'}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 8px;"><strong>Nomor Surat</strong></td>
                                                                    <td>:</td>
                                                                    <td style="padding: 8px;">${response.nomor_surat ?? '-'}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 8px;"><strong>Tanggal Surat</strong></td>
                                                                    <td>:</td>
                                                                    <td style="padding: 8px;">${response.tanggal_surat ? new Date(response.tanggal_surat).toLocaleDateString('id-ID') : '-'}</td>
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
                        $('#editButton').attr('href', `/kelembagaan/${id}/edit`);

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
            justify-content: space-between;
            align-items: center;
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