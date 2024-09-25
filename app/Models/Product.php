<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'technical_description',
        'price',
        'category_id',
        'image',
    ];
    protected $translatable = [
        'title',
        'slug',
        'description',
        'short_description',
        'technical_description',
    ];
}
