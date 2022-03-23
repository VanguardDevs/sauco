<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Str;
use Session;

class ManageTokenController extends Controller
{
    public function login(LoginRequest $request)
    {
        // Check email
        $user = User::where('login', $request->login)->first();

        if (!$user) {
            return response()->json([
                'errors' => [
                    'login' => ['Login incorrecto']
                ]
            ], 401);
        }

        // Check password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'errors' => [
                    'password' => ['Contraseña incorrecta']
                ]
            ], 401);
        }

        $token = $user->createToken(Str::random(20))->plainTextToken;
        // $permissions = collect($user->roles()->pluck('name'))
        //     ->merge($user->permissions()->pluck('name'));

        return response()->json([
            'user' => $user->toJson(),
            'token' => $token,
            'permissions' => ''
        ], 201);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'data' => 'Logged out!'
        ], 200);
    }
}
