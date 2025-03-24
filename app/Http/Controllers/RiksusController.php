<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riksus;
use Illuminate\Support\Facades\DB;

class RiksusController extends Controller
{

    public function edit($id)
    {
        $riksus = Riksus::findOrFail($id);
        $jenis_industri = DB::table('daftarljk')->distinct()->pluck('jenis_industri');
        $nama_perusahaan = DB::table('daftarljk')
            ->where('jenis_industri', $riksus->jenis_industri)
            ->pluck('nama_perusahaan');

        return view('pengendaliankualitas.edit-riksus', compact('riksus', 'jenis_industri', 'nama_perusahaan'));
    }



    public function create()
    {
        $jenis_industri = DB::table('daftarljk')->distinct()->pluck('jenis_industri');
        return view('pengendaliankualitas.riksus', compact('jenis_industri'));
    }

    public function getCompaniesByIndustry(Request $request)
    {
        $companies = DB::table('daftarljk')
            ->where('jenis_industri', $request->jenis_industri)
            ->pluck('nama_perusahaan');
        return response()->json($companies);
    }

    public function index(Request $request)
    {
        // Filter default: 1 bulan terakhir
        $startDate = $request->input('start_date', now()->subMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        // Query dengan filter tanggal tanpa relasi
        $riksus = Riksus::whereBetween('tanggal_nd_pelimpahan', [$startDate, $endDate])->get();

        return view('pengendaliankualitas.view-riksus', compact('riksus', 'startDate', 'endDate'));
    }

public function store(Request $request)
{
    // Validasi form input (optional)
    $validatedData = $request->validate([
        'kode_riskus' => 'required|string',
        'jenis_industri' => 'nullable|string',
        'nama_perusahaan' => 'nullable|string',
        'no_nd_pelimpahan' => 'nullable|string',
        'tanggal_nd_pelimpahan' => 'nullable|date',
        'no_rkpk' => 'nullable|string',
        'tanggal_rkpk' => 'nullable|date',
        'no_surat_tugas' => 'nullable|string',
        'tanggal_surat_tugas' => 'nullable|date',
        'periode_pemeriksaan_surat_tugas' => 'nullable|string',
        'tanggal_qa' => 'nullable|date',
        'tanggal_expose' => 'nullable|date',
        'paparan_ke_pvml' => 'nullable|string',
        'no_nd_ke_dpjk' => 'nullable|string',
        'tanggal_nd_ke_dpjk' => 'nullable|date',
        'no_bast_ke_dpjk' => 'nullable|string',
        'tanggal_bast_ke_dpjk' => 'nullable|date',
        'no_lhpk_ke_dpjk' => 'nullable|string',
        'tanggal_lhpk_ke_dpjk' => 'nullable|date',
        'no_nd_penyampaian_lhpk_ke_pengawas_dpjk' => 'nullable|string',
        'tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk' => 'nullable|date',
        'tanggal_kpkp' => 'nullable|date',
        'no_siputri' => 'nullable|string',
        'tanggal_siputri' => 'nullable|date',
        'tanggal_persetujuan_kadep' => 'nullable|date',
    ]);

    // Membuat data baru
    $riksus = new Riksus();
    $riksus->kode_riskus = $request->kode_riskus;
    $riksus->jenis_industri = $request->jenis_industri;
    $riksus->nama_perusahaan = $request->nama_perusahaan;
    $riksus->no_nd_pelimpahan = $request->no_nd_pelimpahan;
    $riksus->tanggal_nd_pelimpahan = $request->tanggal_nd_pelimpahan;
    $riksus->no_rkpk = $request->no_rkpk;
    $riksus->tanggal_rkpk = $request->tanggal_rkpk;
    $riksus->no_surat_tugas = $request->no_surat_tugas;
    $riksus->tanggal_surat_tugas = $request->tanggal_surat_tugas;
    $riksus->periode_pemeriksaan_surat_tugas = $request->periode_pemeriksaan_surat_tugas;
    $riksus->tanggal_qa = $request->tanggal_qa;
    $riksus->tanggal_expose = $request->tanggal_expose;
    $riksus->paparan_ke_pvml = $request->paparan_ke_pvml;
    $riksus->no_nd_ke_dpjk = $request->no_nd_ke_dpjk;
    $riksus->tanggal_nd_ke_dpjk = $request->tanggal_nd_ke_dpjk;
    $riksus->no_bast_ke_dpjk = $request->no_bast_ke_dpjk;
    $riksus->tanggal_bast_ke_dpjk = $request->tanggal_bast_ke_dpjk;
    $riksus->no_lhpk_ke_dpjk = $request->no_lhpk_ke_dpjk;
    $riksus->tanggal_lhpk_ke_dpjk = $request->tanggal_lhpk_ke_dpjk;
    $riksus->no_nd_penyampaian_lhpk_ke_pengawas_dpjk = $request->no_nd_penyampaian_lhpk_ke_pengawas_dpjk;
    $riksus->tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk = $request->tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk;
    $riksus->tanggal_kpkp = $request->tanggal_kpkp;
    $riksus->no_siputri = $request->no_siputri;
    $riksus->tanggal_siputri = $request->tanggal_siputri;
    $riksus->tanggal_persetujuan_kadep = $request->tanggal_persetujuan_kadep;

    // Menyimpan data ke database
    $riksus->save();

    // Redirect atau memberikan feedback ke pengguna
    return redirect()->route('riksus.index')->with('success', 'Data Riksus berhasil ditambahkan!');
}


    public function show($id)
    {
        return response()->json(Riksus::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        // Find the existing record
        $riksus = Riksus::findOrFail($id);
        
        // Validate the request
        $validated = $request->validate([
            'kode_riskus' => 'required|unique:riksus,kode_riskus,'.$id, // Ignore current record in unique check
            'jenis_industri' => 'nullable|string',
            'nama_perusahaan' => 'nullable|string',
            'no_nd_pelimpahan' => 'nullable|string',
            'tanggal_nd_pelimpahan' => 'nullable|date',
            'no_rkpk' => 'nullable|string',
            'tanggal_rkpk' => 'nullable|date',
            'no_surat_tugas' => 'nullable|string',
            'tanggal_surat_tugas' => 'nullable|date',
            'periode_pemeriksaan_surat_tugas' => 'nullable|string',
            'tanggal_qa' => 'nullable|date',
            'tanggal_expose' => 'nullable|date',
            'paparan_ke_pvml' => 'nullable|string',
            'no_nd_ke_dpjk' => 'nullable|string',
            'tanggal_nd_ke_dpjk' => 'nullable|date',
            'no_bast_ke_dpjk' => 'nullable|string',
            'tanggal_bast_ke_dpjk' => 'nullable|date',
            'no_lhpk_ke_dpjk' => 'nullable|string',
            'tanggal_lhpk_ke_dpjk' => 'nullable|date',
            'no_nd_penyampaian_lhpk_ke_pengawas_dpjk' => 'nullable|string',
            'tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk' => 'nullable|date',
            'tanggal_kpkp' => 'nullable|date',
            'no_siputri' => 'nullable|string',
            'tanggal_siputri' => 'nullable|date',
            'tanggal_persetujuan_kadep' => 'nullable|date',
        ]);
    
        try {
            // Update the record with validated data
            $riksus->update([
                'kode_riskus' => $request->kode_riskus,
                'jenis_industri' => $request->jenis_industri,
                'nama_perusahaan' => $request->nama_perusahaan,
                'no_nd_pelimpahan' => $request->no_nd_pelimpahan,
                'tanggal_nd_pelimpahan' => $request->tanggal_nd_pelimpahan,
                'no_rkpk' => $request->no_rkpk,
                'tanggal_rkpk' => $request->tanggal_rkpk,
                'no_surat_tugas' => $request->no_surat_tugas,
                'tanggal_surat_tugas' => $request->tanggal_surat_tugas,
                'periode_pemeriksaan_surat_tugas' => $request->periode_pemeriksaan_surat_tugas,
                'tanggal_qa' => $request->tanggal_qa,
                'tanggal_expose' => $request->tanggal_expose,
                'paparan_ke_pvml' => $request->paparan_ke_pvml,
                'no_nd_ke_dpjk' => $request->no_nd_ke_dpjk,
                'tanggal_nd_ke_dpjk' => $request->tanggal_nd_ke_dpjk,
                'no_bast_ke_dpjk' => $request->no_bast_ke_dpjk,
                'tanggal_bast_ke_dpjk' => $request->tanggal_bast_ke_dpjk,
                'no_lhpk_ke_dpjk' => $request->no_lhpk_ke_dpjk,
                'tanggal_lhpk_ke_dpjk' => $request->tanggal_lhpk_ke_dpjk,
                'no_nd_penyampaian_lhpk_ke_pengawas_dpjk' => $request->no_nd_penyampaian_lhpk_ke_pengawas_dpjk,
                'tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk' => $request->tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk,
                'tanggal_kpkp' => $request->tanggal_kpkp,
                'no_siputri' => $request->no_siputri,
                'tanggal_siputri' => $request->tanggal_siputri,
                'tanggal_persetujuan_kadep' => $request->tanggal_persetujuan_kadep,
            ]);
            $request = Riksus::findOrFail($id);
    
            $request->updated_by = session('name');  // Menyimpan nama pengguna yang sedang login
        
            // Menyimpan perubahan ke database
            $request->save();
    
            return redirect()->route('riksus.index')
                ->with('success', 'Data berhasil diperbarui');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data. ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Riksus::destroy($id);
        return response()->json(['message' => 'Data deleted']);
    }
}
