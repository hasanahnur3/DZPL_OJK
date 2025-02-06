<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QualityControl;

class QualityControlController extends Controller
{
    public function index()
    {
        $qualityControls = QualityControl::all();
        return view('pengendaliankualitas.view-quality_control', compact('qualityControls'));
    }

    public function create()
    {
        return view('pengendaliankualitas.quality_control');
    }

    public function store(Request $request)
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

        QualityControl::create($request->all());
        return redirect()->route('quality_control.index')->with('success', 'Data berhasil disimpan.');
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
