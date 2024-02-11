<?php

namespace App\Http\Controllers\AuthControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class SignUpController extends Controller
{
    public $token;

    public function signup(Request $Request)
    {
        $validatedData = Validator::make(($Request->all()),[
            'name'  => 'required',
            'email'   => 'required|email|unique:users',
            'password'=> 'required|min:8|confirmed',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $user = User::create([
            'name'  => $Request->name,
            'email'   => $Request->email,
            'password'=> Hash::make($Request->input('password')),
        ]);   

        $this->token = JWTAuth::fromUser($user);

        return response()->json([
            'status' => 'success',
            'message' => 'user registered successfully',
            'token' => $this->token , 
            'user' => $user ,
        ]);
    }

}
