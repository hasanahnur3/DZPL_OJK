<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QualityControl;
use Illuminate\Support\Facades\DB;

class QualityControlController extends Controller
{
    public function index()
    {
        $qualityControls = QualityControl::all();
        return view('pengendaliankualitas.view-quality_control', compact('qualityControls'));
    }

    public function create()
    {
        // Using the correct field name from daftarljk table
        $jenis_industri = DB::table('daftarljk')->distinct()->pluck('jenis_industri');
        return view('pengendaliankualitas.quality_control', compact('jenis_industri'));
    }

    public function getCompaniesByIndustry(Request $request)
    {
        try {
            $companies = DB::table('daftarljk')
                ->where('jenis_industri', $request->jenis_industri)
                ->pluck('nama_perusahaan')
                ->toArray();
    
            return response()->json($companies);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
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
        'follow_up_deadline' => 'required|date',
        'panelists' => 'required|string',
        'supervisors' => 'required|string',
        'document_submission_date' => 'required|date',
        'working_days' => 'required|integer',
        'document_number' => 'required|string',
        'follow_up_submission_date' => 'required|date',
        'follow_up_status' => 'required|in:Belum Lengkap,Sudah Lengkap'
    ]);

    try {
        QualityControl::create($validatedData);
        return redirect()->route('quality_control.index')
            ->with('success', 'Data berhasil disimpan.');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
            ->withInput();
    }
}

        public function edit($id)
{
    $qualityControls= QualityControl::findOrFail($id);
    $jenis_industri = DB::table('daftarljk')->distinct()->pluck('jenis_industri');
    $nama_perusahaan = DB::table('daftarljk')
        ->where('jenis_industri', $qualityControls->jenis_industri)
        ->pluck('nama_perusahaan');

    return view('pengendaliankualitas.edit-quality_control', compact('qualityControls', 'jenis_industri', 'nama_perusahaan'));
}

public function update(Request $request, QualityControl $qualityControl)
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
        // Map the form input fields to database fields
        $qualityControlData = $request->all();

        // Menyimpan siapa yang melakukan update
        $qualityControlData['updated_by'] = session('name'); // Menyimpan nama pengguna yang sedang login

        // Update data
        $qualityControl->update($qualityControlData);

        // Redirect dengan pesan sukses
        return redirect()->route('quality_control.index')
            ->with('success', 'Data berhasil diperbarui.');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
            ->withInput();
    }
}


    public function destroy(QualityControl $qualityControl)
    {
        $qualityControl->delete();
        return redirect()->route('quality_control.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}