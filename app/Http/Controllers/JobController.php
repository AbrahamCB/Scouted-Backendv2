<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class JobController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['index', 'find', 'search', 'findBySlugAndCompany', 'findByTag', 'findByCompany', 'findByCountry', 'findByState', 'show']]);

    }

    public function index()
    {
        return Job::orderBy('id', 'DESC')->with(['company', 'tags', 'referars', 'country', 'state', 'timezone'])->get();
    }

    public function find($id)
    {
        return Job::where('id', $id)
            ->with(['company', 'tags', 'referars', 'country', 'state'])
                ->first();
    }


    public function search($search)
    {
        return Job::where('job_title','like','%'.$search.'%')
            ->with(['company', 'tags', 'referars', 'country', 'state'])
                ->get();
    }

    public function findBySlugAndCompany($company_slug, $job_slug)
    {
        return Job::where('job_slug', $job_slug)
            ->with(['company', 'tags', 'referars', 'country', 'state'])
                ->whereHas('company', function ($query) use ($company_slug) {
                    $query->where('company_slug', $company_slug);
                })
                ->first();
    }

    public function findByCompany($company_slug)
    {
        return Job::with(['company', 'tags', 'referars', 'country', 'state'])
                ->whereHas('company', function ($query) use ($company_slug) {
                    $query->where('company_slug', $company_slug);
                })
                ->get();
    }

    public function findByTag($tag_slug)
    {
        return Job::with(['company', 'tags', 'referars', 'country', 'state'])
                ->whereHas('tags', function ($query) use ($tag_slug) {
                    $query->where('tag_slug', $tag_slug);
                })
                ->get();
    }

    public function findByCountry($country_slug)
    {
        return Job::with(['company', 'tags', 'referars', 'country', 'state'])
                ->whereHas('country', function ($query) use ($country_slug) {
                    $query->where('country_slug', $country_slug);
                })
                ->get();
    }

    public function findByState($state)
    {
        return Job::with(['company', 'tags', 'referars', 'country', 'state'])
                ->whereHas('state', function ($query) use ($state) {
                    $query->where('state_name','like','%'.$state.'%');
                })
                ->get();
    }

    public function show($id)
    {
        return Job::findOrFail(intval($id));
    }

    public function store(Request $request)
    {   

        $validator = Validator::make(
            $request->all(),
            [   
                'job_title' => 'required|string|between:2,30',
                'job_description' => 'required|string|between:2,9999',
                'min_salary' => 'required|numeric',
                'max_salary' => 'required|numeric',
                'salary_currency' => 'required|string',
                'job_bounty' => 'required|numeric',
                'job_vacancy' => 'required|numeric',
                'working_hours' => 'required|string',
                'joining_date' => 'required|string',
                'expiry_date' => 'required|string',
                '_hourly' => 'required|boolean',
                'hourly_rate' => 'string',
                '_remote' => 'boolean',
                'job_type' => 'required|string',
                'company_id' => 'required|numeric',
                'country_id' => 'required|numeric',
                'state_id' => 'required|numeric',
                '_timezone' => 'string',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        $job = Job::create(
            array_merge(
                [
                    'job_slug' => Str::slug($request->job_title, '-')
                ],
                $validator->validated()
            )
        );

        $job->tags()->attach($request->tags);

        if ($job) {
            return response()->json([
                'success' => true,
                'message' => 'Job created successfully.'
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
         $validator = Validator::make(
            $request->all(),
            [   
                'job_title' => 'string|between:2,30',
                'job_description' => 'string|between:2,9999',
                'min_salary' => 'numeric',
                'max_salary' => 'numeric',
                'salary_currency' => 'string',
                'job_bounty' => 'numeric',
                'job_vacancy' => 'numeric',
                'working_hours' => 'string',
                'joining_date' => 'string',
                'expiry_date' => 'string',
                '_hourly' => 'boolean',
                'hourly_rate' => 'string',
                '_remote' => 'boolean',
                'job_type' => 'string',
                'company_id' => 'numeric',
                'country_id' => 'numeric',
                'state_id' => 'numeric',
                '_timezone' => 'string',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        if (Job::findOrFail($id)->update(
            array_merge(
                $validator->validated(),
                [
                    'job_slug' => Str::slug($request->job_title, '-')
                ]
            ))) 
        {   
            
            Job::findOrFail($id)->tags()->sync($request->tags);

            return response()->json([
                'success' => true,
                'message' => 'Job updated successfully.'
            ], 201);
        }
    }
    
    public function destory($id)
    {
       $job = Job::findOrFail($id);

       if($job)
       {
           $job->delete();
           return response()->json(
                [
                    'success' => true,
                    'message' => 'Job updated successfully.'
                ], 422);
       } 
    }
}
