<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Support\Str;

class LogoutResponse implements LogoutResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $user = $request->user();
        dd($user);
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
