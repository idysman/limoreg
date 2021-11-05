<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'service_name',
        'description',
        'item_code',
    ];


    public function service_component(){
        return $this->hasMany(ServiceComponent::class);
    }
}
