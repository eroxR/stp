<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements Auditable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //relación muchos a muchos
    public function contractData()
    {
        return $this->belongsToMany('App\Models\Contract');
    }

    //relación muchos a muchos
    public function entityData()
    {
        return $this->belongsToMany('App\Models\Entity');
    }


    //relación muchos a muchos
    public function cpvd()
    {
        return $this->belongsToMany('App\Models\Cpvd');
    }

    //relación uno a muchos polimorfica
    public function documentsData()
    {
        return $this->morphMany('App\Models\Document', 'documentable');
    }

    //relación uno a muchos
    public function bondingData()
    {
        return $this->belongsTo('App\Models\Bonding', 'bonding_type');
    }

    //relación uno a muchos
    public function identificationData()
    {
        return $this->belongsTo('App\Models\Identification', 'identification');

        // return $this->belongsTo(identification::class);
    }

    //relación uno a muchos
    public function relationshipData()
    {
        return $this->belongsTo('App\Models\Relationship', 'relationship');
    }

    //relación uno a muchos
    public function supplierCategoryData()
    {
        return $this->belongsTo('App\Models\SupplierCategory', 'supplier_category');
    }

    //relación uno a muchos
    public function chargeData()
    {
        return $this->belongsTo('App\Models\Charge', 'charge');
    }

    //relación uno a muchos
    public function economicActivityData()
    {
        return $this->belongsTo('App\Models\EconomicActivity', 'economic_activity');
    }

    //relación uno a muchos
    public function cityData()
    {
        return $this->belongsTo('App\Models\City', 'city');
    }

    //relación uno a muchos
    public function cityBirthData()
    {
        return $this->belongsTo('App\Models\City', 'city_birth');
    }

    //relación uno a muchos
    public function countryData()
    {
        return $this->belongsTo('App\Models\Country', 'country');
    }


    //relación uno a muchos
    public function workAreaData()
    {
        return $this->belongsTo('App\Models\WorkArea', 'work_area');
    }

    //relación uno a muchos
    public function compensationBoxData()
    {
        return $this->belongsTo('App\Models\CompensationBox', 'compensationbox');
    }

    //relación uno a muchos
    public function layoffsData()
    {
        return $this->belongsTo('App\Models\layoffs', 'layoffs');
    }

    //relación uno a muchos
    public function healthEntityData()
    {
        return $this->belongsTo('App\Models\HealthEntity', 'eps');
    }

    //relación uno a muchos
    public function bloodTypeData()
    {
        return $this->belongsTo('App\Models\BloodType', 'blood_type');
    }

    //relación uno a muchos
    public function productsAndServicesData()
    {
        return $this->belongsTo('App\Models\ProductsAndService', 'products_and_services');
    }


    //relación uno a uno
    public function vehicleData()
    {
        return $this->hasOne('App\Models\Vehicle', 'assigned_vehicle');
    }

    //relación uno a muchos
    public function usertypeData()
    {
        return $this->belongsTo('App\Models\UserType', 'usertype');
    }

    //relación uno a muchos polimorfica
    public function beneficiaryData()
    {
        return $this->morphMany('App\Models\Document', 'beneficiary');
    }

    //relación uno a muchos
    public function companyData()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    //relación uno a muchos
    function branchData()
    {
        return $this->belongsTo('App\Models\Branch', 'branch_id');
    }

    //relación uno a muchos
    public function educationLevelData()
    {
        return $this->belongsTo('App\Models\EducationalLevel', 'education_level');
    }

    //relación uno a muchos
    public function civilStatusData()
    {
        return $this->belongsTo('App\Models\MaritalStatus', 'civil_status');
    }

    //relación uno a muchos
    public function shoeSizeData()
    {
        return $this->belongsTo('App\Models\ShoeSize', 'shoe_size');
    }

    //relación uno a muchos


    protected $fillable = [

        'username',
        'identification',
        'identificationcard',
        'firstname',
        'secondname',
        'lastname',
        'motherslastname',
        'birthdate',
        'age',
        'type_sex',
        'country',
        'department',
        'city',
        'address',
        'phone',
        'phone_cellular',
        'blood_type',
        'user_status',
        'user_entry_date',
        'date_withdrawal_user',
        'date_refund',
        'charge',
        'usertype',
        'civil_status',
        'family_document_type',
        'family_names',
        'relationship',
        'family_address',
        'family_phone',
        'family_phone_cellular',
        'city_birth',
        'place_expedition_identificationcard',
        'identificationcard_family',
        'bonding_type',
        'weight',
        'pant_size',
        'shirt_size',
        'shoe_size',
        'education_level',
        'educational_institution',
        'last_course',
        'study_end_date',
        'obtained_title',
        'last_company_name',
        'charges_last_company',
        'start_date_last_company',
        'date_end_last_company',
        'functions_performed',
        'salary',
        'aid_transport',
        'work_area',
        'email',
        'email_verified_at',
        'password',
        'password_changed_at',
        'license_category',
        'assigned_vehicle',
        'driver_status',
        'linked',
        'isLinked',
        'company_id',
        'code_company',
        'branch_id',
        'type_access',

    ];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['names'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function names(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => trim($attributes['firstname'] . ' ' . $attributes['lastname']),
        );
    }
}
