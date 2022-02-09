<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_name',
        'candidate_email',
        'candidate_website',
        'candidate_description',
        'referrer_familiarity',
        'referrer_description'
    ];
}
