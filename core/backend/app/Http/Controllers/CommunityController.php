<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Http\Requests\Communities\CommunitiesCreateFormRequest;
use App\Http\Requests\Communities\CommunitiesUpdateFormRequest;

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
    public function index(Request $request)
    {
        $query = Community::latest();
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('name', $filters)) {
                $query->whereLike('name', $filters['name']);
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
    public function store(CommunitiesCreateFormRequest $request)
    {
        $community = Community::create($request->all());
        $community->parishes()->sync($request->parishes);

        return response()->json($community, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
        return $community;
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
        $community->update($request->all());
        $community->parishes()->sync($request->parishes);

        return response()->json($community, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        $community->delete();

        return response()->json($community, 201);
    }
}
