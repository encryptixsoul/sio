<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'phone_number', 'image', 'username', 'first_name', 'last_name', 'dob'
    ];

    public function followers()
    {
        return $this->hasMany(ProfileFollower::class);
    }

    public function following()
    {
        return $this->hasMany(ProfileFollowing::class);
    } 
}
