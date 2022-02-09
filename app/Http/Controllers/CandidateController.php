<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{
    public function index()
    {
        return Candidate::orderBy('id', 'DESC')->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'candidate_name'=> 'required|string',
                'candidate_email'=> 'required|email',
                'candidate_website'=> 'required|string',
                'candidate_description'=> 'required|string',
                'referrer_familiarity'=> 'required|string',
                'referrer_description'=> 'required|string'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        $candidate = Candidate::create(
            $validator->validated()
        );

        if ($candidate) {
            return response()->json([
                'success' => true,
                'message' => 'Candidate created successfully.'
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'candidate_name'=> 'required|string',
                'candidate_email'=> 'required|email',
                'candidate_website'=> 'required|string',
                'candidate_description'=> 'required|string',
                'referrer_familiarity'=> 'required|string',
                'referrer_description'=> 'required|string'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        $candidate = Candidate::findOrFail($id)->update(
            $validator->validated()
        );

        if ($candidate) {
            return response()->json([
                'success' => true,
                'message' => 'Candidate updated successfully.'
            ], 201);
        }
    }
    
    public function destory($id)
    {
       $candidate = Candidate::findOrFail($id);

       if($candidate)
       {
           $candidate->delete();
           return response()->json(
                ['message'=>'Candidate deleted successfully.'],
                422
            );
       } 
    }
}
