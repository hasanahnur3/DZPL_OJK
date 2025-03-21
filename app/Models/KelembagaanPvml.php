<?php
// In app/Models/KelembagaanPvml.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KelembagaanPvml extends Model
{
    protected $table = 'kelembagaan';
    protected $guarded = [];
    
    // Updated accessor method to return negative values when SLA is exceeded
    public function getSlaRemainingAttribute()
    {
        // Jika status adalah "selesai", kembalikan "-"
        if (strtolower($this->status) === 'selesai') {
            return '-';
        }
    
        if (!$this->tanggal_dokumen_lengkap) {
            return '-';
        }
    
        // Ambil nilai SLA dari tabel izin_industri
        $izinIndustri = DB::table('izin_industri')
            ->where('id', $this->jenis_izin)
            ->first();
    
        if (!$izinIndustri || !$izinIndustri->sla) {
            return '-';
        }
    
        // Hitung jumlah hari kerja yang telah berlalu sejak tanggal dokumen lengkap
        $completionDate = Carbon::parse($this->tanggal_dokumen_lengkap);
        $today = Carbon::now();
    
        $businessDaysPassed = 0;
        $currentDate = clone $completionDate;
    
        while ($currentDate->lte($today)) {
            // Hitung hanya hari kerja (Senin-Jumat)
            if ($currentDate->dayOfWeek >= 1 && $currentDate->dayOfWeek <= 5) {
                $businessDaysPassed++;
            }
            $currentDate->addDay();
        }
    
        // Hitung sisa hari kerja SLA (bisa negatif)
        $remainingSla = $izinIndustri->sla - $businessDaysPassed;
    
        return $remainingSla; // Kembalikan nilai SLA (positif atau negatif)
    }
    
    public function izinIndustri()
    {
        return $this->belongsTo('App\Models\IzinIndustri', 'jenis_izin', 'id');
    }
}