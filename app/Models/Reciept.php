<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reciept extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $with = ['reciept_type'];

    public function reciept_type(){
        return $this->hasOne(RecieptType::class,'id','reciept_type_id');
    }
}
