<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelembagaanPvml;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class KelembagaanPvmlController extends Controller
{
    public function index(Request $request)
    {
        // Filter default: 1 bulan terakhir
        $startDate = $request->input('start_date', now()->subMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        // Query dengan filter tanggal
        $kelembagaan = KelembagaanPvml::whereBetween('tanggal_pengajuan_sistem', [$startDate, $endDate])->get();

        return view('perizinanpvml.view-kelembagaan', compact('kelembagaan', 'startDate', 'endDate'));
    }

    public function create()
    {
        return view('perizinanpvml.kelembagaan');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'jenis_industri' => 'required|string|max:255',
                'nama_perusahaan' => 'required|string|max:255',
                'detail_izin' => 'nullable|string',
                'status' => 'required|string|max:50',
                'nomor_surat_permohonan' => 'nullable|string|max:100',
                'tanggal_surat_permohonan' => 'nullable|date',
                'tanggal_pengajuan_sistem' => 'nullable|date',
                'tanggal_dokumen_lengkap' => 'nullable|date',
                'tanggal_selesai_analisis' => 'nullable|date',
                'sla' => 'nullable|integer|min:0',
                'nomor_surat' => 'nullable|string|max:100',
                'tanggal_surat' => 'nullable|date',
                'jumlah_hari_kerja' => 'nullable|integer|min:0',
            ]);

            // Menyimpan data ke database "ojk"
            KelembagaanPvml::on('ojk')->create($validated);

                    // Filter default: 1 bulan terakhir
        $startDate = $request->input('start_date', now()->subMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        // Query dengan filter tanggal
        $kelembagaan = KelembagaanPvml::whereBetween('tanggal_surat_permohonan', [$startDate, $endDate])->get();

        return view('perizinanpvml.view-kelembagaan', compact('kelembagaan', 'startDate', 'endDate'));
            // return redirect()->route('kelembagaan.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data')->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $kelembagaan = KelembagaanPvml::on('ojk')->findOrFail($id);
            return view('perizinanpvml.edit-kelembagaan', compact('kelembagaan'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, KelembagaanPvml $qualityControl)
    {
        $validatedData = $request->validate([
            'jenis_industri' => 'required|string',
            'criteria' => 'required|string',
            'nama_perusahaan' => 'required|string',
            'forum_date' => 'required|date',
            'financial_issues' => 'required|string',
            'non_financial_issues' => 'required|string',
            'root_cause' => 'required|string',
            'main_recommendation' => 'required|string',
            'supporting_recommendation' => 'required|string',
            'follow_up_deadline' => 'date',
            'panelists' => 'required|string',
            'supervisors' => 'required|string',
            'document_submission_date' => 'required|date',
            'working_days' => 'required|integer',
            'document_number' => 'required|string',
            'follow_up_submission_date' => 'required|date',
            'follow_up_status' => 'in:Belum Lengkap,Sudah Lengkap',
            'follow_up_status_description' => 'nullable|string',
        ]);
    
        try {
            // Set 'updated_by' to the logged-in user
            $validatedData['updated_by'] = session('name'); // Store the name of the user currently logged in
    
            // Update the model with the validated data
            $qualityControl->update($validatedData);
    
            // Redirect with success message
            return redirect()->route('quality_control.index')
                ->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        return response()->json(KelembagaanPvml::findOrFail($id));
    }
    
}