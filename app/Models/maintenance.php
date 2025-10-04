<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class maintenance extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\MaintenanceFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación uno a muchos con Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    //relación uno a muchos con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //relación uno a muchos con Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }       
    //relación uno a muchos con Branch
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    protected $fillable = [
        'vehicle_id',
        'usuario_id',
        'maintenance_provider',
        'maintenance_date',
        'mileage',
        'type_maintenance',
        'description',
        'company_id',
        'code_company',
        'branch_id'
    ];
}
