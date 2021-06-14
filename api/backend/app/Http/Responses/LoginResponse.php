<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Str;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $user = $request->user();
        // Create sessions
        $user->sessions()->create();
        $token = $user->createToken(Str::random(20))->plainTextToken;
        $permissions = collect($user->roles()->pluck('name'))
            ->merge($user->permissions()->pluck('name'));

        return response()->json([
            'user' => $user,
            'token' => $token,
            'permissions' => base64_encode($permissions)
        ], 201);
    }
}
