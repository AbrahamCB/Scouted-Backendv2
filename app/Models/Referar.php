<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referar extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_name',
        'referrer_email',
        '_referrerurl',
        'candidate_name',
        'candidate_email',
        '_candidateurl',
        'job_id',
    ];
}
