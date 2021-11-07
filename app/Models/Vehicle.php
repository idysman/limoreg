<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'engine_number',
        'chassis_number',
        'plate_number',
        'model',
        'category',
        'owner_id',
        'vehicle_type_id',
        'policy_number',
        'engine_capacity',
        'tank_capacity',
        'odometer',
        'created_by',
        'color',
        'fuel_type',
        'year_of_manufacture',
        'iirs_id',
        'tin',
    ];
}
