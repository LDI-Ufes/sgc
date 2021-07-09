<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'cpf',
        'job',
        //gender
        'birthday',
        //'birth_state',
        'birth_city',
        'id_number',
        //id_type
        'id_issue_date',
        'id_issue_agency',
        //marital_status
        'spouse_name',
        'father_name',
        'mother_name',
        'address_street',
        'address_complement',
        'address_number',
        'address_district',
        'address_postal_code',
        //address_state
        'address_city',
        'area_code',
        'phone',
        'mobile',
        'email',
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function birthState()
    {
        return $this->belongsTo(State::class);
    }

    public function idType()
    {
        return $this->belongsTo(IdType::class);
    }

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function addressState()
    {
        return $this->belongsTo(State::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
    

}
