<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'email',
        'tel_1',
        'tel_2',
        'latitude',
        'longitude',
    ];
}
