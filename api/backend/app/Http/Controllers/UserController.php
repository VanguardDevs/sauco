<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UsersCreateFormRequest;
use App\Http\Requests\Users\UpdatePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Image;
use File;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Auth;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::latest();
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;
            // Get fields
            if (array_key_exists('login', $filters)) {
                $query->whereLogin($filters['login']);
            }
            if (array_key_exists('roles', $filters)) {
                $query->whereHas('roles', function ($query) use ($filters) {
                    return $query->whereLike('name', $filters['roles']);
                });
            }
            if (array_key_exists('status', $filters)) {
                $status = ($filters['status'] == 'Activos') ? 1 : 0;
                $query->whereActive($status);
            }
        }

        return $query->paginate($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersCreateFormRequest $request)
    {
        $create = new User([
            'identity_card' => $request->input('identity_card'),
            'first_name' => $request->input('first_name'),
            'password' => bcrypt($request->input('password')),
            'surname' => $request->input('surname'),
            'phone' => $request->input('phone'),
            'login' => $request->input('login')
        ]);
        $create->save();

        $create->roles()->sync($request->get('roles'));

        return redirect()->route('users.index')->withSuccess('¡Usuario agregado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    public function getUser(Request $request)
    {
        $user = $request->user();

        return response()->json($user);
    }

    public function showChangePassword()
    {
        return view('modules.users.change-password');
    }

    public function updatePassword(UpdatePassword $request)
    {
        $newPassword = $request->input('new-password');
        $currentPass = $request->input('current-password');
        $user = Auth::user();

        if (!Hash::check($currentPass, $user->password)) {
            return Redirect::back()
                ->withError('¡Tu contraseña actual es incorrecta!');
        }

        if ($currentPass == $newPassword) {
            return Redirect::back()
                ->withError('¡La nueva contraseña no debe ser igual a la anterior!');
        }

        $user->password = bcrypt($newPassword);
        $user->save();

        return Redirect::back()
            ->withSuccess('¡Contraseña actualizada!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $edit             = User::find($user->id);
        $edit->login = $request->input('login');
        $edit->first_name = $request->input('first_name');
        $edit->surname    = $request->input('surname');

        if ($request->input('password') != NULL) {
            $edit->password   = bcrypt($request->input('password'));
        }
        $edit->roles()->sync($request->get('roles'));
        $edit->save();

        return redirect()->route('users.index')
            ->withSuccess('¡Usuario actualizado!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
