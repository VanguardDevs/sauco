<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UsersCreateFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Image;
use File;
use DataTables;
use App\User;
use Caffeinated\Shinobi\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.users.index');
    }

    public function list()
    {
        $query = User::query();

        return DataTables::eloquent($query)
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("modules.users.register")
            ->with('roles', Role::pluck('name', 'id'))
            ->with('typeForm', 'create');
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
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'surname' => $request->input('surname'),
            'phone' => $request->input('phone'),
            'login' => $request->input('login')
        ]);
        $create->save();

        $create->roles()->sync($request->get('roles'));

        return redirect('administration/users')->withSuccess('¡Usuario agregado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     *
     * User profile
     *
     */
    public function profile($id)
    {
        return view("modules.users.profile");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("modules.users.register")
            ->with('typeForm', 'update')
            ->with('roles', Role::pluck('name', 'id'))
            ->with('row', $user);
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
        $edit->first_name = $request->input('name');
        $edit->surname    = $request->input('surname');
        
        if ($request->input('password') != NULL) {
            $edit->password   = bcrypt($request->input('password'));
        }
        $edit->roles()->sync($request->get('roles'));

        return Redirect::back()
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
