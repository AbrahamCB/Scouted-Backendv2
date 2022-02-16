<?php

namespace App\Http\Controllers;

use App\Models\Social;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['index', 'find', 'findBySlug']]);
    }

    public function index()
    {   
        return Company::with(['country', 'state'])
            ->get();
    }

    public function find($id)
    {   
        return Company::findOrFail($id)
            ->with(['country', 'state'])
                ->first();
    }

    public function findBySlug($slug)
    {   
        return Company::where('company_slug', $slug)
            ->with(['country', 'state'])
                ->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [   
                'company_name' => 'required|string|between:2,50',
                'company_description' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'website_url' => 'required|string',
                'crunchbase_url' => 'string',
                'employee_number' => 'required|numeric',
                'founded_date' => 'string',
                'facebook_url'  => 'required|string',
                'twitter_url' => 'string',
                'linkedin_url' => 'string',
                'instagram_url' => 'string',
                'country_id' => 'required|numeric',
                'state_id' => 'required|numeric',
                '_timezone' => 'string',
                'status' => 'boolean',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }


        if($request->hasFile('image')){

            $company = Company::create(
                array_merge(
                    $validator->validated(),
                    [
                        'company_slug' => Str::slug( $request->company_name, '-'),
                        'company_logo' => $request->image->store('companies', 'public'),
                    ]

                )
            );

            if ($company) {
                return response()->json([
                    'success' => true,
                    'message' => 'Company created successfully.'
                ], 201);
            }
        }else{

            $company = Company::create(
                array_merge(
                    [
                        'company_slug' => Str::slug( $request->company_name, '-'),
                    ],
                    $validator->validated()
                )
            );

            if ($company) {
                return response()->json([
                    'success' => true,
                    'message' => 'Company created successfully.'
                ], 201);
            }
        } 
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'company_name' => 'string|between:2,50',
                'company_description' => 'string',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'website_url' => 'string',
                'crunchbase_url' => 'string',
                'employee_number' => 'numeric',
                'founded_date' => 'string',
                'facebook_url'  => 'string',
                'twitter_url' => 'string',
                'linkedin_url' => 'string',
                'instagram_url' => 'string',
                'country_id' => 'numeric',
                'state_id' => 'numeric',
                '_timezone' => 'string',
                'status' => 'boolean',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        if($request->hasFile('image')){

        }else{
            if (Company::findOrFail($id)->update(
                array_merge(
                    $validator->validated(),
                    [
                        'company_slug' => Str::slug( $request->company_name, '-'),
                    ]
                ))) 
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Company updated successfully.'
                ], 201);
            }
        }
    }
    
    public function destory($id)
    {
       $tag = Company::findOrFail($id);

       if($tag)
       {
           $tag->delete();
           return response()->json(
                ['message'=>'Company deleted successfully.'],
                422
            );
       } 
    }

}

