<?php

namespace App\Http\Controllers;

use App\Community;
use App\Http\Requests\Communities\CommunitiesCreateFormRequest;
use App\Parish;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CommunityController extends Controller
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
            ->with('parishes', Parish::get())
            ->with('typeForm', 'create');
    }

    public function list()
    {
        $query = Community::query();

        return DataTables::eloquent($query)->toJson();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Community $community)
    {
        //
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
