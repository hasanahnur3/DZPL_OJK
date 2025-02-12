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

    public function edit(QualityControl $qualityControl)
    {
        $jenis_industri = DB::table('daftarljk')->distinct()->pluck('jenis_industri');
        return view('pengendaliankualitas.edit-quality_control', compact('qualityControl', 'jenis_industri'));
    }

    public function update(Request $request, QualityControl $qualityControl)
    {
        $validatedData = $request->validate([
            'jenis_industri' => 'required|string',
            'criteria' => 'required|string',
            'nama_perusahaan' => 'required|string',
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
            // Map the form input fields to database fields
            $qualityControlData = [
                'jenis_industri' => $request->input('jenis_industri'), // Map from form to database field
                'nama_perusahaan' => $request->input('nama_perusahaan'), // Map from form to database field
                'criteria' => $request->criteria,
                'pvml_utama' => $request->pvml_utama,
                'special_monitoring_status' => $request->special_monitoring_status,
                'intensive_monitoring_status' => $request->intensive_monitoring_status,
                'other_considerations' => $request->other_considerations,
                'forum_date' => $request->forum_date,
                'financial_issues' => $request->financial_issues,
                'non_financial_issues' => $request->non_financial_issues,
                'root_cause' => $request->root_cause,
                'main_recommendation' => $request->main_recommendation,
                'supporting_recommendation' => $request->supporting_recommendation,
                'follow_up_deadline' => $request->follow_up_deadline,
                'panelists' => $request->panelists,
                'supervisors' => $request->supervisors,
                'document_submission_date' => $request->document_submission_date,
                'working_days' => $request->working_days,
                'document_number' => $request->document_number,
                'follow_up_submission_date' => $request->follow_up_submission_date,
                'follow_up_status' => $request->follow_up_status,
                'follow_up_status_description' => $request->follow_up_status_description,
            ];

            $qualityControl->update($qualityControlData);
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