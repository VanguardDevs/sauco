<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Http\Requests\Categories\CategoriesCreateFormRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.settings.categories.index');
    }

    public function list()
    {
        $query = Listing::query();

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.settings.categories.register')
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesCreateFormRequest $request)
    {
        Listing::create($request->input());

        return redirect()->route('categories.index')
            ->withSuccess('¡Categoría creada!');
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
    public function edit(Listing $category)
    {
        return view('modules.settings.categories.register')
            ->with('row', $category)
            ->with('typeForm', 'update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesCreateFormRequest $request, Listing $category)
    {
        $category->update($request->input());

        return redirect()->route('categories.index')
            ->withSuccess('¡Categoría actualizada!');
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
