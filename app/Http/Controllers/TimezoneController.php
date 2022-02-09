<?php

namespace App\Http\Controllers;

use App\Models\Timezone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TimezoneController extends Controller
{
    public function index($id)
    {
        return Timezone::where('country_id', $id)->get();
    }

    public function store(Request $request)
    {   

        $validator = Validator::make(
            $request->all(),
            [   
                '_zone_name_' => 'required|string|between:2,30|unique:timezones',
                'country_id' => 'numeric'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        if (Timezone::create($validator->validated())) 
        {
            return response()->json([
                'success' => true,
                'message' => 'Time zone added successfully.'
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {   
        $validator = Validator::make(
            $request->all(),
            [
                '_zone_name_' => 'required|string|between:2,30',
                'country_id' => 'numeric'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        if (Timezone::findOrFail($id)->update($validator->validated())) 
        {
            return response()->json([
                'success' => true,
                'message' => 'Time zone updated successfully.'
            ], 201);
        }
    }
}
