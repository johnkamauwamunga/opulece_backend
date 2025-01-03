<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // Correct namespace

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'hire_date',
    ];
}
