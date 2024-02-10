<?php

namespace App\Http\Controllers\AuthControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{   
    public function login(Request $Request){
        $validatedData = Validator::make(($Request->all()),[
            'email'   => 'required|email',
            'password'=> 'required|min:8',
        ]); 
        
        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $credentials = $Request->only('email','password');

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        
        // .. Get the user from the token ..
        $user = JWTAuth::user();
        
        return response()->json([
            'status' =>'success',
            'message'=>'user logged in successfully',
            'token'  =>$token,
            'user'   =>$user,
        ]);
    }

}