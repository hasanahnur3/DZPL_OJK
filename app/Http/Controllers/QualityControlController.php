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
        $jenis_industri = DB::table('daftarljk')->distinct()->pluck('jenis_industri');
        return view('pengendaliankualitas.quality_control', compact('jenis_industri'));
    }

    public function getCompaniesByIndustry(Request $request)
    {
        $companies = DB::table('daftarljk')
            ->where('jenis_industri', $request->jenis_industri)
            ->pluck('nama_perusahaan');
        return response()->json($companies);
    }


    public function store(Request $request)
{
    $validatedData = $request->validate([
        'industry_type' => 'required|string',
        'criteria' => 'required|string',
        'company_name' => 'required|string',
        'pvml_utama' => 'required|string',
        'special_monitoring_status' => 'required|string',
        'intensive_monitoring_status' => 'required|string',
        'other_considerations' => 'required|string',
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
        'follow_up_status' => 'required|in:Belum Lengkap,Sudah Lengkap',
        'follow_up_status_description' => 'nullable|string',
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

    public function edit(QualityControl $qualityControl)
    {
        return view('pengendaliankualitas.edit-quality_control', compact('qualityControl'));
    }

    public function update(Request $request, QualityControl $qualityControl)
    {
        $request->validate([
            'industry_type' => 'required|string',
            'criteria' => 'required|string',
            'company_name' => 'required|string',
            'forum_date' => 'nullable|date',
            'financial_issues' => 'nullable|string',
            'non_financial_issues' => 'nullable|string',
            'root_cause' => 'nullable|string',
            'main_recommendation' => 'nullable|string',
            'supporting_recommendation' => 'nullable|string',
            'follow_up_deadline' => 'nullable|date',
            'panelists' => 'nullable|string',
            'supervisors' => 'nullable|string',
            'document_submission_date' => 'nullable|date',
            'working_days' => 'nullable|integer',
            'document_number' => 'nullable|string',
            'follow_up_submission_date' => 'nullable|date',
            'follow_up_status' => 'nullable|in:Belum Lengkap,Sudah Lengkap',
        ]);

        $qualityControl->update($request->all());
        return redirect()->route('quality_control.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(QualityControl $qualityControl)
    {
        $qualityControl->delete();
        return redirect()->route('quality_control.index')->with('success', 'Data berhasil dihapus.');
    }
}
