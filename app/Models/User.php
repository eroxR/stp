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
    public function contract()
    {
        return $this->belongsToMany('App\Models\contract');
    }

    //relación uno a muchos polimorfica
    public function documents()
    {
        return $this->morphMany('App\Models\document', 'documentable');
    }

    //relación uno a muchos
    public function bonding()
    {
        return $this->belongsTo('App\Models\bonding');
    }

    //relación uno a muchos
    public function identification()
    {
        return $this->belongsTo('App\Models\identification');

        // return $this->belongsTo(identification::class);
    }

    //relación uno a muchos
    public function relationship()
    {
        return $this->belongsTo('App\Models\relationship');
    }

    //relación uno a muchos
    public function supplierCategory()
    {
        return $this->belongsTo('App\Models\supplierCategory');
    }

    //relación uno a muchos
    public function charge()
    {
        return $this->belongsTo('App\Models\charge');
    }

    //relación uno a muchos
    public function economicActivity()
    {
        return $this->belongsTo('App\Models\economicActivity');
    }

    //relación uno a muchos
    public function city()
    {
        return $this->belongsTo('App\Models\city');
    }

    //relación uno a muchos
    public function country()
    {
        return $this->belongsTo('App\Models\country');
    }

    //relación uno a muchos
    public function Province()
    {
        return $this->belongsTo('App\Models\Province');
    }

    //relación uno a muchos
    public function workArea()
    {
        return $this->belongsTo('App\Models\workArea');
    }

    //relación uno a muchos
    public function arl()
    {
        return $this->belongsTo('App\Models\arl');
    }

    //relación uno a muchos
    public function compensationBox()
    {
        return $this->belongsTo('App\Models\compensationBox');
    }

    //relación uno a muchos
    public function layoffs()
    {
        return $this->belongsTo('App\Models\layoffs');
    }

    //relación uno a muchos
    public function healthEntity()
    {
        return $this->belongsTo('App\Models\healthEntity');
    }

    //relación uno a muchos
    public function pension()
    {
        return $this->belongsTo('App\Models\pension');
    }

    //relación uno a muchos
    public function bloodType()
    {
        return $this->belongsTo('App\Models\bloodType');
    }

    //relación uno a muchos
    public function productsAndServices()
    {
        return $this->belongsTo('App\Models\productsAndServices');
    }

    //relación uno auno
    public function driver()
    {
        return $this->hasOne('App\Models\driver', 'user_id', 'user_id');
    }

    //relación uno a muchos
    public function vehicle()
    {
        return $this->hasMany('App\Models\vehicle');
    }

    //relación uno a muchos
    public function usertype()
    {
        return $this->belongsTo('App\Models\usertype');
    }

    //relación uno a muchos polimorfica
    public function beneficiary()
    {
        return $this->morphMany('App\Models\document', 'beneficiary');
    }

    //relación uno a muchos
    public function company()
    {
        return $this->belongsTo('App\Models\company');
    }

    //relación uno a muchos
    function branch()
    {
        return $this->belongsTo('App\Models\branch');
    }

    //relación uno a muchos
    public function educationLevel()
    {
        return $this->belongsTo('App\Models\educationLevel');
    }

    //relación uno a muchos
    public function civilStatus()
    {
        return $this->belongsTo('App\Models\civilStatus');
    }

    //relación uno a muchos
    public function shoeSize()
    {
        return $this->belongsTo('App\Models\shoeSize');
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
        'Department',
        'city',
        'address',
        'phone',
        'phone_cellular',
        'eps',
        'date_eps',
        'blood_type',
        'pension',
        'date_pension',
        'layoffs',
        'date_layoffs',
        'arl',
        'arl_date',
        'compensationbox',
        'date_compensationbox',
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
        'nit',
        'supplier_name',
        'company_name_provider',
        'commercial_reason_supplier',
        'supplier_web_page',
        'supplier_category',
        'economic_activity',
        'products_and_services',
        'supplier_description',
        'company_id',
        'code_company',
        'branch_id',

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
            get: fn ($value, $attributes) => trim($attributes['firstname'] . ' ' . $attributes['lastname']),
        );
    }
}
