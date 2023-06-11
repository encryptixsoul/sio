<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'phone_number', 'image', 'username', 'first_name', 'last_name', 'dob'
    ];
}
