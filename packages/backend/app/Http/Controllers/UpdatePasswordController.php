<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use Hash;

class UpdatePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdatePasswordRequest $request)
    {
        $newPassword = $request->input('new_password');
        $currentPass = $request->input('current_password');
        $user = $request->user();

        if (!Hash::check($currentPass, $user->password)) {
            return response()->json([
                'errors' => [
                    'current_password' => 'Contraseña incorrecta'
                ]
            ], 422);
        }

        if ($currentPass == $newPassword) {
            return response()->json([
                'errors' => [
                    'new_password' => 'La nueva contraseña no debe ser igual a la anterior.'
                ]
            ], 422);
        }

        $user->password = bcrypt($newPassword);
        $user->save();

        return response()->json([
            'success' => true
        ], 200);
    }
}
