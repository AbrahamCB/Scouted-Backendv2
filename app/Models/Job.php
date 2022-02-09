<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'job_slug',
        'job_description',
        'job_salary',
        'job_condition',
        'job_vacancy',
        'job_referer',
        'job_interviewer',
        'hired',
        'job_bounty',
        'job_salary',
        'company_id',
        'country_id',
        'timezone_id',
        'state_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function referars()
    {
        return $this->belongsToMany(Referar::class, 'job_referar', 'job_id', 'referer_id');
    }
}
