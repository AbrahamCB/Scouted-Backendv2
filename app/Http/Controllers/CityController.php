<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index($id)
    {
        return City::where('state_id', $id)->get();
    }

    public function store(Request $request)
    {   

        $validator = Validator::make(
            $request->all(),
            [   
                'city_name' => 'required|string|between:2,30',
                'country_id' => 'required|numeric',
                'state_id' => 'required|numeric'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        if (City::create($validator->validated())) 
        {
            return response()->json([
                'success' => true,
                'message' => 'City added successfully.'
            ], 201);
        }
    }


    public function update(Request $request, $id)
    {   
        $validator = Validator::make(
            $request->all(),
            [
                'state_name' => 'string|between:2,30',
                'country_id' => 'numeric',
                'state_id' => 'numeric'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        if (City::findOrFail($id)->update($validator->validated())) 
        {
            return response()->json([
                'success' => true,
                'message' => 'City updated successfully.'
            ], 201);
        }
    }
}

