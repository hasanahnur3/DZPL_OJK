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
        <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Daftar Riksus</h2>
        <table id="riksusTable" class="table table-striped"
            style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; text-align: left;">
            <thead>
                <tr>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Kode Riksus</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Jenis Industri</th>
                    <th style="padding: 0.75rem; border: 1px solid #dee2e6;">Nama Perusahaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riksus as $riksusItem)
                    <tr>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $riksusItem->id }}">
                            {{ $riksusItem->kode_riskus }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $riksusItem->id }}">
                            {{ $riksusItem->jenis_industri }}
                        </td>
                        <td style="padding: 0.75rem; border: 1px solid #dee2e6; cursor: pointer;" class="open-modal"
                            data-id="{{ $riksusItem->id }}">
                            {{ $riksusItem->nama_perusahaan }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Button Add Data -->
        <div class="button-container mb-3">
            <x-modal-filter :action="route('riksus.index')" :startDate="$startDate" :endDate="$endDate" />
            @if (!in_array(Session::get('role'), ['direktur', 'deputi', 'kabag', 'kadep', 'kepala_eksekutif']))
                <a href="{{ route('riksus.create') }}" class="btn btn-success">Add Data</a>
            @endif
        </div>
    </div>

    <!-- Modal untuk Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Sosialisasi Riksus</h5>

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
            $('#riksusTable').DataTable({
                "pageLength": 5
            });

            // Event untuk membuka modal
            $(document).on('click', '.open-modal', function () {
                const id = $(this).data('id');

                // AJAX request untuk mendapatkan detail
                $.ajax({
                    url: `/riksus/${id}`, // Sesuaikan dengan route backend
                    type: 'GET',
                    success: function (response) {
                        // Isi modal dengan detail data
                        $('#modalContent').html(`
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                                        <table style=" border-collapse: collapse;">
                                            <tr>
                                                <td style="padding: 8px;"><strong>Kode Riksus</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.kode_riskus}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>Jenis Industri</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.jenis_industri}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>Nama Perusahaan</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;" >  ${response.nama_perusahaan}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>No ND Pelimpahan</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.no_nd_pelimpahan}</td>
                                            </tr>
        <tr>
                                                <td style="padding: 8px;"><strong>Tanggal ND Pelimpahan</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.tanggal_nd_pelimpahan ? new Date(response.tanggal_nd_pelimpahan).toLocaleDateString('id-ID') : '-'}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>No RKPK</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.no_rkpk}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>Tanggal RKPK</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;" >  ${response.tanggal_rkpk ? new Date(response.tanggal_rkpk).toLocaleDateString('id-ID') : '-'}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>No Surat Tugas</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.no_surat_tugas}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>Tanggal Surat Tugas</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.tanggal_surat_tugas ? new Date(response.tanggal_surat_tugas).toLocaleDateString('id-ID') : '-'}</td>
                                            </tr>

                                            <tr>
                                                <td style="padding: 8px;"><strong>Periode Pemeriksaan</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.periode_pemeriksaan_surat_tugas}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>Tanggal QA</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;" >  ${response.tanggal_qa ? new Date(response.tanggal_qa).toLocaleDateString('id-ID') : '-'}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>Tanggal Expose</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.tanggal_expose ? new Date(response.tanggal_expose).toLocaleDateString('id-ID') : '-'}</td>
                                            </tr>
        <tr>
                                                <td style="padding: 8px;"><strong>Paparan Ke PVML</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.paparan_ke_pvml}</td>
                                            </tr>
                                            </table>
                                            <table style=" border-collapse: collapse;">
                                            <tr>
                                                <td style="padding: 8px;"><strong>No ND Ke DPJK</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.no_nd_ke_dpjk}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>Tanggal ND Ke DPJK</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;" >  ${response.tanggal_nd_ke_dpjk ? new Date(response.tanggal_nd_ke_dpjk).toLocaleDateString('id-ID') : '-'}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>No BAST Ke DPJK</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.no_bast_ke_dpjk}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>Tanggal BAST Ke DPJK</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.tanggal_bast_ke_dpjk ? new Date(response.tanggal_bast_ke_dpjk).toLocaleDateString('id-ID') : '-'}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>No LHPK Ke DPJK</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.no_lhpk_ke_dpjk}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>Tanggal LHPK Ke DPJK</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;" >  ${response.tanggal_lhpk_ke_dpjk ? new Date(response.tanggal_lhpk_ke_dpjk).toLocaleDateString('id-ID') : '-'}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>No ND Penyampaian LHPK ke DPJK</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.no_nd_penyampaian_lhpk_ke_pengawas_dpjk}</td>
                                            </tr>
        <tr>
                                                <td style="padding: 8px;"><strong>Tanggal ND Penyampaian LHPK ke DPJK</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk ? new Date(response.tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk).toLocaleDateString('id-ID') : '-'}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>Tanggal KKPK</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.tanggal_kpkp ? new Date(response.tanggal_kpkp).toLocaleDateString('id-ID') : '-'}
        </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>No SIPUTRI</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;" >${response.no_siputri}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>Tanggal SIPUTRI</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.tanggal_siputri ? new Date(response.tanggal_siputri).toLocaleDateString('id-ID') : '-'}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;"><strong>Tanggal Persetujuan Kadep</strong></td>
                                                <td>:</td>
                                                <td style="padding: 8px;">${response.tanggal_persetujuan_kadep ? new Date(response.tanggal_persetujuan_kadep).toLocaleDateString('id-ID') : '-'}
        </td>
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
                                        </div>
                                    `);
                        // Set href button Edit
                        $('#editButton').attr('href', `/pengendaliankualitas/riksus/${id}/edit`);

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