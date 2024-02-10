<?php

namespace App\Http\Controllers\AuthControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:api');
    }

    public function logout(Request $request){

        $user = auth()->user();

        $token = JWTAuth::parseToken();

        $loggedOut = $token->invalidate();

        if ($loggedOut) {
            // .. Logout Done Successfully ..
            return response()->json([
                'message'=>'user logged out successfully',
            ]);
        }
        // .. If Any Error Happen In Logging Out ..
        return response()->json([
            'message'=>'user doesnt logged out',
        ]);
    }
}
