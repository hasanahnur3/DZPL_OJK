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
        if (!$this->tanggal_dokumen_lengkap) {
            return '-';
        }
        
        // Get the corresponding SLA value from izin_industri table
        $izinIndustri = DB::table('izin_industri')
            ->where('id', $this->jenis_izin)
            ->first();
            
        if (!$izinIndustri || !$izinIndustri->sla) {
            return '-';
        }
        
        // Calculate business days passed since document completion
        $completionDate = Carbon::parse($this->tanggal_dokumen_lengkap);
        $today = Carbon::now();
        
        // Count only business days (Monday-Friday)
        $businessDaysPassed = 0;
        $currentDate = clone $completionDate;
        
        while ($currentDate->lte($today)) {
            // Check if current day is a weekday (1 = Monday, 5 = Friday)
            if ($currentDate->dayOfWeek >= 1 && $currentDate->dayOfWeek <= 5) {
                $businessDaysPassed++;
            }
            $currentDate->addDay();
        }
        
        // Calculate remaining SLA business days (can be negative)
        $remainingSla = $izinIndustri->sla - $businessDaysPassed;
        
        return $remainingSla; // Return the actual value (positive or negative)
    }
    
    public function izinIndustri()
    {
        return $this->belongsTo('App\Models\IzinIndustri', 'jenis_izin', 'id');
    }
}