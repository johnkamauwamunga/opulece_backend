<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBody extends Model
{
    use HasFactory;

    protected $fillable = [
        'body_type',
    ];
}
