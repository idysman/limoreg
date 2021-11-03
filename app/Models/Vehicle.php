<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'owner_fname' ,
        'owner_surname' ,
        'owner_email',
        'owner_license_number',
        'owner_phone',
        'engine_number',
        'chassis_number',
        'plate_number',
        'model',
        'category',
        'vehicle_type_id',
        'policy_number',
        'engine_capacity',
        'tank_capacity',
        'odometer',
        'created_by',
        'color',
        'fuel_type',
        'year_of_manufacture',
        'title',
        'address',
        'owner_identification',
        'identification_no',
        'state',
        'lga'
    ];
}
