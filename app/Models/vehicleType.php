<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceComponent;

class VehicleType extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'title',
        'description',
    ];

    public function service_component(){
        $this->hasMany(ServiceComponent::class);
    }
}
