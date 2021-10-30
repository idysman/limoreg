<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        "vehicle_type_id",
        "service_id",
        'amount',
    ];


    public function vehicle_type(){
        return $this->belongsTo(VehicleType::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
