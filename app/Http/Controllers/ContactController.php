<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['store']]);
    }

    public function index()
    {
        return Contact::orderBy('id', 'DESC')->get();
    }

    public function store(Request $request)
    {   

        $validator = Validator::make(
            $request->all(),
            [   
                'name' => 'required|string|between:2,30',
                'email' => 'required|string|between:2,50',
                'message' => 'required|string|between:2,250',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        if (Contact::create($validator->validated())) 
        {
            return response()->json([
                'success' => true,
                'message' => 'Message send successfully.'
            ], 201);
        }
    }

    public function destory($id)
    {
       if($contact = Contact::findOrFail($id))
       {
           $contact->delete();
           return response()->json(
                ['message'=>'Message deleted successfully.'],
                422
            );
       } 
    }
}
