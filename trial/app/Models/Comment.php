<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // Correct namespace

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'students_id'];
}
