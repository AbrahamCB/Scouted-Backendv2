<?php

namespace App\Http\Controllers;

use App\Models\Timezone;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SetupController extends Controller
{
    public function run()
    {   
    $client = new Client();
    $res = $client->get('http://worldtimeapi.org/api/timezone');
    $timezone = json_decode($res->getBody()); 

    foreach($timezone as $t)
    {
        Timezone::create([
            'time_zone_area' => $t
        ]);
    }
        // $response = Http::get('http://worldtimeapi.org/api/timezone');
        // return $response->body();
    }
}
