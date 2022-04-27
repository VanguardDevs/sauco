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
use PDF;

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
        $filters = $request->has('filter') ? $request->filter : [];
        $sort = $request->sort;
        $order = $request->order;

        // Get fields
        if (array_key_exists('full_name', $filters)) {
            $query->whereLike('full_name', $filters['full_name']);
        }
        if (array_key_exists('login', $filters)) {
            $query->whereLike('login', $filters['login']);
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
        if (array_key_exists('id', $filters)) {
            $query->find($filters['id']);
        }

        if ($sort && $order) {
            $query->orderBy($sort, $order);
        }

        if ($request->type == 'pdf') {
            return $this->report($query);
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
            'names' => $request->input('names'),
            'surnames' => $request->input('surnames'),
            'login' => $request->input('login'),
            'password' => bcrypt($request->input('password')),
            'phone' => $request->input('phone'),
            'avatar'=> $request->input('avatar')
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

    public function report($query)
    {
        // Prepare pdf
        $models = $query->get();
        $title = "Listado de Usuarios";

        $pdf = PDF::LoadView('pdf.reports.users', compact([
            'models',
            'title'
        ]));

        return $pdf->download('usuarios.pdf');
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
        $data = [
            'identity_card' => $request->identity_card,
            'names' => $request->names,
            'surnames' => $request->surnames,
            'login' => $request->login
        ];

        $user->roles()->sync($request->roles_ids);

        if ($request->password != NULL) {
            $data->password = bcrypt($request->password);
        }

        $user->update($data);
        $user->roles()->sync($request->roles_ids);

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
        $destroy  = User::find($user->id);
        $destroy->active=0;

        $destroy->save();

    }
}
