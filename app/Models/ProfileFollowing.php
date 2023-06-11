<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileFollowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id', 'following_id'
    ];
}
