<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Http\Requests\Communities\CommunitiesCreateFormRequest;
use App\Http\Requests\Communities\CommunitiesUpdateFormRequest;
use App\Parish;
use Yajra\DataTables\Facades\DataTables;

class CommunityController extends Controller
{
    public function __construct()
    {
        $this->middleware('has.role:admin')
            ->only(['create', 'edit', 'store', 'update']);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.communities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.communities.register')
            ->with('parishes', Parish::pluck('name', 'id'))
            ->with('typeForm', 'create');
    }

    public function list()
    {
        $query = Community::get();

        return DataTables::of($query)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommunitiesCreateFormRequest $request)
    {
        $parishes = $request->input('parishes');
        $community = new Community([
            'name' => $request->input('name')
        ]);
        $community->save();

        $community->parishes()->attach($parishes);

        return redirect('geographic-area/communities')
            ->withSuccess('¡Comunidad añadida!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
        return view('modules.communities.show')
            ->with('row', $community);
    }

    public function listTaxpayers(Community $community)
    {
        return DataTables::eloquent($community->taxpayers())
            ->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        return view('modules.communities.register')
            ->with('typeForm', 'update')
            ->with('parishes', Parish::pluck('name', 'id'))
            ->with('row', $community);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function update(CommunitiesUpdateFormRequest $request, Community $community)
    {
        $parishes = $request->input('parishes');
        $row = Community::find($community->id);
        $row->name = $request->input('name');

        $row->parishes()->sync($parishes);

        return redirect('geographic-area/communities')
            ->withSuccess('¡Comunidad actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        //
    }
}
