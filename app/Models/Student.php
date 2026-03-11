<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $timestamps = false; // Disable timestamps if not needed
    protected $fillable = [
        'name',
        'email',
        'phone',
        'age'
    ];
}
