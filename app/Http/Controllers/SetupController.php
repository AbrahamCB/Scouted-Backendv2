<?php

namespace App\Http\Controllers;

use App\Models\State;
use GuzzleHttp\Client;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SetupController extends Controller
{
    public function country()
    {   
        $client = new Client();
        $res = $client->get('https://v3.bachelortimes.com/api/countries');
        $countries = json_decode($res->getBody()); 


        // return $countries;

        foreach($countries as $country)
        {
            Country::create([
                'country_name' => $country->name,
                'country_slug' => Str::slug($country->name, '-'),
                'timezones' => $country->timezones,
                'country_code' => $country->iso2
            ]);
        }
        return 'Country inserted';
    }

    public function state()
    {   
        $client = new Client();
        $res = $client->get('https://v3.bachelortimes.com/api/states/2');
        $states = json_decode($res->getBody()); 


        // return $countries;

        foreach($states as $state)
        {
            State::create([
                'state_name' => $state->name,
                'country_id' => $state->country_id
            ]);
        }
        return 'State inserted';
    }
}


