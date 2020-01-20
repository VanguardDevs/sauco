<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Caffeinated\Shinobi\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $options = [
        'route' => 'permissions',
        'route-views' => 'modules.permissions.'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->options['route-views']."index")
            ->with('permissions', Permission::get())
            ->with('options', $this->options);
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
        $create = new Permission();
        $create->name = $request->input('name');
        $create->slug = $request->input('slug');
        $create->description = $request->input('description');

        if($create->save()) {
            return redirect('administration/'.$this->options['route'])->with('success', 'Permiso agregado!!');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view($this->options['route-views']."register")
            ->with('options', $this->options)
            ->with('typeForm', 'update')
            ->with('row', $permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $edit       = Permission::find($permission->id);
        $edit->name = $request->input('name');
        $edit->slug = $request->input('slug');
        $edit->description = $request->input('description');

        if($edit->save()) {
            return redirect('administration/'.$this->options['route'])->withSuccess('Permiso actualizado!!');
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
