<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = request(['login', 'password']);
        $credentials['active'] = true;
        $credentials['deleted_at'] = null;

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'email' => 'Tu contraseña o usuario son inválidos.'
                ]
            ], 401);
        }

        $user = Auth::user();

        $tokenResult = $user->createToken('authToken');

        return response()->json([
            'token' => $tokenResult->accessToken,
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([ 'success' => true ]);
    }

    public function renewToken(Request $request)
    {
        //
    }

    public function getUser(Request $request)
    {
        return response()->json([
            'user' => $request
                ->user()
        ]);
    }
}
