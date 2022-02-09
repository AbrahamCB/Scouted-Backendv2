<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    protected $fillable = [
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
    ];
}
