<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            $tokenResult = $user->createToken('userToken');
            $token = $tokenResult->token;
            $token->save();
            
            return response()->json([
                'token' => $tokenResult->accessToken
            ]);
        }
    }
}
