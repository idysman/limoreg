<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecieptType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function reciepts(){
        return $this->belongsToMany(Reciept::class);
    }
}
