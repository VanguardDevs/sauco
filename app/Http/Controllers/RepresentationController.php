<?php

namespace App\Http\Controllers;

use App\Citizenship;
use App\Taxpayer;
use App\Http\Requests\Representations\RepresentationsCreateFormRequest;
use App\Representation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RepresentationController extends Controller
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
        return view('modules.representations.index');
    }

    public function list()
    {
        $query = Representation::query();

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $taxpayer = Taxpayer::find($id);

        return view('modules.representations.register')
            ->with('citizenships', Citizenship::pluck('description', 'id'))
            ->with('taxpayer', $taxpayer)
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, RepresentationsCreateFormRequest $request)
    {
        $document = $request->input('document');
        $correlative = Citizenship::find($request->input('citizenship'))->correlative;

        $create = new Representation([
            'document' => $correlative.$document,
            'first_name' => $request->input('first_name'),
            'second_name' => $request->input('second_name'),
            'surname' => $request->input('surname'),
            'second_surname' => $request->input('second_surname'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'citizenship_id' => $request->input('citizenship'),
            'taxpayer_id' => $id
        ]);
        $create->save();

        return redirect('taxpayers/'.$id)
            ->withSuccess('¡Representante registrado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Representation  $representation
     * @return \Illuminate\Http\Response
     */
    public function show(Representation $representation)
    {
        return view('modules.representations.show')
            ->with('row', $representation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Representation  $representation
     * @return \Illuminate\Http\Response
     */
    public function edit(Representation $representation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Representation  $representation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Representation $representation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Representation  $representation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Representation $representation)
    {
        //
    }
}
