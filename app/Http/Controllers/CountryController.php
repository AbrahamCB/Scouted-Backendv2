<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function index()
    {
        return Country::all();
    }

    public function store(Request $request)
    {   

        $validator = Validator::make(
            $request->all(),
            [   
                'country_name' => 'required|string|between:2,30|unique:countries',
                'country_code' => 'required|string|between:2,10'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        if (Country::create(
            array_merge(
                $validator->validated(),
                [
                    'country_slug' => Str::slug($request->country_name, '-')
                ]
            ))) 
        {
            return response()->json([
                'success' => true,
                'message' => 'Country added successfully.'
            ], 201);
        }
    }


    public function update(Request $request, $id)
    {   
        $validator = Validator::make(
            $request->all(),
            [
                'country_name' => 'required|string|between:2,30',
                'country_code' => 'required|string|between:2,10'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        if (Country::findOrFail($id)->update(
            array_merge(
                $validator->validated(),
                [
                    'country_slug' => Str::slug($request->country_name, '-')
                ]
            ))) 
        {
            return response()->json([
                'success' => true,
                'message' => 'Country updated successfully.'
            ], 201);
        }
    }


}
