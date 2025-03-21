<?php

namespace App\Exports;

use App\Models\Tka;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TkaExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Tka::whereBetween('tanggal_surat_peromohonan', [$this->startDate, $this->endDate])->get();
    }

    public function headings(): array
    {
        return [
            'Nama Perusahaan',
            'Jenis Industri',
            'Nomor Surat Permohonan',
            'Tanggal Surat Permohonan',
            'Status Perizinan',
            'Jenis Output',
            'Tanggal Dokumen Lengkap',
            'Nomor Surat Tanggapan',
            'Tanggal Surat Tanggapan'
        ];
    }
    public function map($tka): array
    {
        return [
            $tka->nama_perusahaan,
            $tka->jenis_industri,
            $tka->nomor_surat_permohonan,
            $tka->tanggal_surat_permohonan,
            $tka->status_perizinan,
            $tka->jenis_output,
            $tka->tanggal_dok_lengkap,
            $tka->no_surat_pencatatan,
            $tka->tanggal_surat_pencatatan,
        ];
    }
}