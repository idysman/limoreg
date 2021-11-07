<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Owner extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'owner_fname' ,
        'owner_surname' ,
        'owner_email',
        'owner_license_number',
        'owner_phone',
        'title',
        'address',
        'owner_identification',
        'identification_no',
        'state',
        'lga'
    ];
}
