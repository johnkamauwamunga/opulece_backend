<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'make',
        'model',
        'year_made',
        'mileage',
        'fuel_type',
        'transmission',
        'description',
        'price',
        'status',
    ];
}
