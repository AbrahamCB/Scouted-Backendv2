<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_slug',
        'company_description',
        'company_logo',
        'website_url',
        'crunchbase_url',
        'employee_number',
        'founded_date',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'country_id',
        'state_id',
        '_timezone',
        'status'
    ];

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function timezone(){
        return $this->belongsTo(Timezone::class);
    }
}
