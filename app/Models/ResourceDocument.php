<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ResourceDocument extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\ResourceDocumentFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;



    //relación con la tabla users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relación con la tabla periods
    public function periodMedicalExams()
    {
        return $this->belongsTo(Period::class, 'period_medical_exams');
    }

    public function periodInductionReinduction()
    {
        return $this->belongsTo(Period::class, 'period_induction_reinduction');
    }

    public function periodAttorneyRecord()
    {
        return $this->belongsTo(Period::class, 'period_attorney_record');
    }

    public function periodComptrollerRecord()
    {
        return $this->belongsTo(Period::class, 'period_comptroller_record');
    }

    public function periodPoliceRecord()
    {
        return $this->belongsTo(Period::class, 'period_police_record');
    }

    //relación con la tabla companies
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    //relación con la tabla branches
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    

    protected $fillable = [
        'user_id',
        'medical_exams',
        'priority_medical_exams',
        'period_medical_exams',
        'induction_reinduction',
        'priority_induction_reinduction',
        'period_induction_reinduction',
        'attorney_record',
        'priority_attorney_record',
        'period_attorney_record',
        'comptroller_record',
        'priority_comptroller_record',
        'period_comptroller_record',
        'police_record',
        'priority_police_record',
        'period_police_record',
        'labor_reference',
        'resume_format',
        'company_id',
        'code_company',
        'branch_id'
    ];
}
