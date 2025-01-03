<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Correct namespace
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
}
