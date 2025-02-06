<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityControl extends Model {
    use HasFactory;

    protected $table = 'quality_control';

    protected $fillable = [
        'industry_type',
        'criteria',
        'company_name',
        'forum_date',
        'financial_issues',
        'non_financial_issues',
        'root_cause',
        'main_recommendation',
        'supporting_recommendation',
        'follow_up_deadline',
        'panelists',
        'supervisors',
        'document_submission_date',
        'working_days',
        'document_number',
        'follow_up_submission_date',
        'follow_up_status'
    ];
}
