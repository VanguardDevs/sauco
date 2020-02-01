<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permissions\PermissionsCreateFormRequest;
use App\Http\Requests\Permissions\PermissionsUpdateFormRequest;
use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
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
        return view("modules.permissions.index");
    }

    public function list()
    {
        $query = Permission::query()->orderBy('slug', 'ASC');

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("modules.permissions.register")
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionsCreateFormRequest $request)
    {
        $create = new Permission([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description')
        ]);
        $create->save();

        return redirect('administration/permissions')->with('success', '¡Permiso agregado!');
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
        return view("modules.permissions.register")
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
    public function update(PermissionsUpdateFormRequest $request, Permission $permission)
    {
        $edit       = Permission::find($permission->id);
        $edit->fill($request->all())->save();

        return redirect('administration/permissions')->withSuccess('¡Permiso actualizado!');
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
