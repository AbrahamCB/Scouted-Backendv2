<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Mail\ReferMail;
use App\Models\Referar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ReferarController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function refer(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [   
                'referrer_name' => 'required|string',
                'referrer_email' => 'required|email',
                '_referrerurl' => 'required|string',
                'candidate_name' => 'required|string',
                'candidate_email' => 'required|email',
                '_candidateurl' => 'required|string',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        if(Referar::where([
            'referrer_email' => $request->referrer_email,
            'candidate_email' => $request->candidate_email,
        ])->count()>0){
            return response()->json([
                'success' => true,
                'message' => 'Already reffered.'
            ], 201);
        }else{
            $refer = Referar::create(
                array_merge(
                    [
                       'job_id' => $id
                    ],
                    $validator->validated()
                ));
    
            DB::table('job_referar')->insert([
                'job_id' => $id,
                'referer_id' => $refer->id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Referred successfully'
            ], 201);
        }
    }


    public function referJobs()
    {
        return Job::with(['company', 'tags', 'referars', 'country', 'state', 'timezone'])
            ->whereHas('referars', function ($query){
                $query->where('referrer_email', Auth::user()->email);
            })
            ->get();
    }


    public function check()
    {
       $details = [
           'title' => 'Lorem is the best policy!',
           'body' => 'This is our body. How can i help you? can you tell me...'
       ];

       Mail::to("dev2kaziarif@gmail.com")->send(new ReferMail($details));

       return "Send";
    }
}
