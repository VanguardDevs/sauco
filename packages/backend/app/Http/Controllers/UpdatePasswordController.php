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
            return $request->json([
                'current_password' => 'Contraseña incorrecta'
            ], 422);
        }

        if ($currentPass == $newPassword) {
            return $request->json([
                'new_password' => 'La nueva contraseña no debe ser igual a la anterior.'
            ], 422);
        }

        $user->password = bcrypt($newPassword);
        $user->save();

        return $request->json([
            'success' => true
        ], 200);
    }
}
