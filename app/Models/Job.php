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
        'job_bounty',
        '_status',
        'job_vacancy',
        'working_hours',
        'joining_date',
        'expiry_date',
        '_hourly',
        'hourly_rate',
        '_remote',
        'job_type',
        'company_id',
        'country_id',
        'state_id',
        '_timezone'
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
