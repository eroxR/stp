<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Contract extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\ContractFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    //relación muchos a muchos
    public function user()
    {
        return $this->belongsToMany('App\Models\user');
    }

    //relación muchos a muchos
    public function vehicle()
    {
        return $this->belongsToMany('App\Models\vehicle');
    }

    //relación uno a muchos polimorfica
    public function documents()
    {
        return $this->morphMany('App\Models\document', 'documentable');
    }

    //relación muchos a muchos
    public function driver()
    {
        return $this->belongsToMany('App\Models\driver');
    }

    //relación uno a muchos
    public function passenger()
    {
        return $this->hasMany('App\Models\passenger');
    }

    //relación uno a muchos inversa
    public function contract_type()
    {
        return $this->belongsTo('App\Models\contract_type');
    }

    //relación uno a muchos inversa
    public function identification()
    {
        return $this->belongsTo('App\Models\identification');
    }

    //relación uno a muchos
    public function permit()
    {
        return $this->hasMany('App\Models\permit');
    }

    protected $fillable = [

        'contract_number',
        'code_order',
        'type_contract',
        'origin_route',
        'destination_route',
        'date_start_contract',
        'date_end_contract',
        'contract_value',
        'contracting_name',
        'status_contract',
        'identification_id',
        'contract_document',
        'expedition_identificationcard',
        'contracting_phone',
        'contracting_direction',
        'contracting_email',
        'legal_representative',
        'identification_represent_legal_id',
        'identificationcard_represent_legal_id',
        'contract_value',
        'contracting_name',
        'status_contract',
        'identification_id',
        'contract_document',
        'expedition_identificationcard',
        'contracting_phone',
        'contracting_direction',
        'contracting_email',
        'legal_representative',
        'identification_represent_legal_id',
        'identificationcard_represent_legal_id',
        'contract_value',
        'contracting_name',
        'status_contract',
        'identification_id',
        'contract_document',
        'expedition_identificationcard',
        'contracting_phone',
        'contracting_direction',
        'contracting_email',
        'legal_representative',
        'identification_represent_legal_id',
        'identificationcard_represent_legal_id',
        'contract_value',
        'contracting_name',
        'status_contract',
        'identification_id',
        'contract_document',
        'expedition_identificationcard',
        'contracting_phone',
        'contracting_direction',
        'contracting_email',
        'legal_representative',
        'identification_represent_legal_id',
        'identificationcard_represent_legal_id',
        'contract_value',
        'contracting_name',
        'school_name',
        'address_school',
        'phone_school',
        'school_year',
        'departure_location',
        'place_arrival',
        'place_return',
        'date_departure_location',
        'date_place_arrival',
        'date_place_return',
        'legal_bond',
        'student_name',
        'identificationcard_estudent',
        'grade_student',
        'family_relationship',
        'who_receives',
        'start_day',
        'end_day',
        'identificationcard_representative_group',
        'group_representative_name',
        'dateofexpedition_representative_group',
        'digital_signature',
        'digital_signature_representative_group',
        'company_id',
        'code_company',
        'branch_id',

    ];
}
