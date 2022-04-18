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
        '_self',
        'candidate_name',
        'candidate_email',
        '_candidateurl',
        'referring_description',
        'person_work',
        'describe_them',
        'opportunities',
        'referring_company',
        'payment_candidate',
        'about_us',
        'job_id'
    ];
}
