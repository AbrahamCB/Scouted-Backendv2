<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
{
    public function index($id)
    {
        return State::where('country_id', $id)->get();
    }

    public function store(Request $request)
    {   

        $validator = Validator::make(
            $request->all(),
            [   
                'state_name' => 'required|string|between:2,30|unique:states',
                'country_id' => 'required|numeric'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        if (State::create($validator->validated())) 
        {
            return response()->json([
                'success' => true,
                'message' => 'State added successfully.'
            ], 201);
        }
    }


    public function update(Request $request, $id)
    {   
        $validator = Validator::make(
            $request->all(),
            [
                'state_name' => 'string|between:2,30',
                'country_id' => 'numeric'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        if (State::findOrFail($id)->update($validator->validated())) 
        {
            return response()->json([
                'success' => true,
                'message' => 'State updated successfully.'
            ], 201);
        }
    }
}
