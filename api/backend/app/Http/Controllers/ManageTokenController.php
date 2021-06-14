<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Str;

class ManageTokenController extends Controller
{
    public function login(LoginRequest $request)
    {
        // Check login
        $user = User::where('login', $request->login)->first();

        // Check password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales inválidas'
            ], 401);
        }

        $token = $user->createToken(Str::random(20))->plainTextToken;
        $permissions = collect($user->roles()->pluck('name'))
            ->merge($user->permissions()->pluck('name'));

        return response()->json([
            'user' => $user->toJson(),
            'token' => $token,
            'permissions' => $permissions->toJson()
        ], 201);
    }

    public function authenticate(Request $request)
    {
        $token = $request->user()->createToken(Str::random(20));

        return response()->json([
            'token' => $token->plainTextToken
        ], 201);
    }

    public function revoke(Request $request)
    {
        $user = $request->user();
        // Revoke token
        $user->tokens()->delete();

        // Save logging out
        $user->sessions()->create([
            'active' => 0,
        ]);

        return response()->json([
            'message' => 'Logged out!'
        ], 200);
    }
}
