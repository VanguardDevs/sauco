<?php

namespace App\Http\Controllers;

use App\Models\Citizenship;
use App\Models\Taxpayer;
use App\Http\Requests\People\PeopleCreateFormRequest;
use App\Models\Person;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PersonController extends Controller
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
        return view('modules.Persons.index');
    }

    public function list()
    {
        $query = Person::query();

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, PeopleCreateFormRequest $request)
    {
        $document = $request->input('document');
        $correlative = Citizenship::find($request->input('citizenship'))->correlative;

        $create = new Person([
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
            ->withSuccess('¡Persona registrada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $Person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $Person)
    {
        return view('modules.people.show')
            ->with('row', $Person);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $Person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $Person)
    {
        return view('modules.people.register')
            ->with('row', $Person)
            ->with('citizenships', Citizenship::pluck('description', 'id'))
            ->with('typeForm', 'update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $Person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        $person->update($request->input());
        
        return redirect()->route('representations.index')
            ->withSuccess('¡Datos de '.$person->identification.' actualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $Person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $Person)
    {
        //
    }
}
