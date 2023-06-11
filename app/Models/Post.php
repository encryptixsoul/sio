<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id', 'caption'
    ];

    public function images()
    {
        return $this->hasMany(PostImage::class);
    } 

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    } 

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    } 
}
