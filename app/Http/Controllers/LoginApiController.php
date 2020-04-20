<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\User;

class LoginApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = request(['name', 'password']);

        if(!Auth::attempt($credentials)){
            return response()->json([
                'success' => false,
                'message' => 'Username or password is incorrect'
            ]);
        }else{
            $user = $request->user();

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;

            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            return response()->json([
                'success' => true,
                'message' => 'Login Success',
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
                'data' => $user
            ]);
        }        
    }

}
