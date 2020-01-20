<?php

namespace App\Http\Controllers;

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

    private $options = [
        'route' => 'users',
        'route-views' => 'modules.users.'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->options['route-views']."index")
                            ->with('options', $this->options)
                            ->with('array', User::get());
    }

    public function listUsers()
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
        return view($this->options['route-views']."register")
                            ->with('options', $this->options)
                            ->with('roles', Role::get())
                            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /***/
        $file = $request->avatar;
        $name = $request->identity_card.'.'.$file->extension();
        /***/
        $create                 = new User();
        $create->identity_card  = $request->input('identity_card');
        $create->first_name     = $request->input('first_name');
        $create->surname        = $request->input('surname');
        $create->phone          = $request->input('phone');
        $create->login          = $request->input('login');
        $create->password       = bcrypt($request->input('password'));
        $create->avatar         = $name;

        if($create->save()) {

            $create->roles()->sync($request->get('roles'));
            /**
             *
             */
            $path = public_path('/uploads/ticket-technical-support/');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }
            $file->move(public_path().'/uploads/users/', $name);
            /**
             *
             */
            return redirect('administration/'.$this->options['route'])->withSuccess('Usuario agregado!!');
        }
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
        return view($this->options['route-views']."profile");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view($this->options['route-views']."register")
            ->with('options', $this->options)
            ->with('typeForm', 'update')
            ->with('roles', Role::get())
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
        $avatar_old       = $edit->avatar;
        $edit->first_name = $request->input('name');
        $edit->surname    = $request->input('surname');
        //$edit->login      = $request->input('login');
        if ($request->input('password') != NULL) {
            $edit->password   = bcrypt($request->input('password'));
        }

        if($edit->save()) {

            $edit->roles()->sync($request->get('roles'));

            if($request->file('avatar') != null) {

                $path = public_path('/uploads/users/');
                $img_path = public_path('/uploads/users/'.$avatar_old.'.png');
                File::delete($img_path);

                Image::make($request->file('avatar'))->save($path.$edit->avatar.'.png');
            }

            return Redirect::back()->withSuccess('Usuario actualizado!!');
        }
    }
    /**
     *
     * Update profile
     *
     */
    public function updateProfile(Request $request, User $user)
    {
        dd($request->file('avatar'));
        $edit             = User::find($user->id);
        $avatar_old       = $edit->avatar;
        //$edit->first_name = $request->input('name');
        //$edit->surname    = $request->input('surname');
        //$edit->login      = $request->input('login');
        if ($request->input('password') != NULL) {
            $edit->password   = bcrypt($request->input('password'));
        }

        if($edit->save()) {

            $edit->roles()->sync($request->get('roles'));

            if($request->file('avatar') != null) {

                $path = public_path('/uploads/users/');
                $img_path = public_path('/uploads/users/'.$avatar_old.'.png');
                File::delete($img_path);

                Image::make($request->file('avatar'))->save($path.$edit->avatar.'.png');
            }

            return Redirect::back()->withSuccess('Usuario actualizado!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
