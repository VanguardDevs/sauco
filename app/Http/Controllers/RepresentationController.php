<?php

namespace App\Http\Controllers;

use App\Representation;
use App\Taxpayer;
use Illuminate\Http\Request;
use App\Person;
use App\RepresentationType;
use App\Citizenship;
use Yajra\DataTables\Facades\DataTables;

class RepresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.taxpayers.representations.index');
    }

    public function list()
    {
        return DataTables::of(Person::get())
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Taxpayer $taxpayer)
    {
        if (($taxpayer->taxpayerType->description != 'JURÍDICO') && 
            (!$taxpayer->commercialDenomination->exists())) {
                return redirect('taxpayers/'.$taxpayer->id)
                    ->withError('¡Este contribuyente no admite un representante!');
        }

        return view('modules.taxpayers.representations.register')
            ->with('representationTypes', RepresentationType::pluck('name', 'id'))
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
    public function store(Request $request, Taxpayer $taxpayer)
    {
        $correlative = Citizenship::find($request->input('citizenship'))->correlative;
        $document = $request->input('document');
        $person = Person::whereDocument($correlative.$document)->first();
        $type = $request->input('representation_type');
        
        if ($person) {
            $hasAssociation = Representation::wherePersonId($person->id)
                ->whereTaxpayerId($taxpayer->id)
                ->get();

            if (!empty($hasAssociation->count())) {
                return redirect('taxpayers/'.$taxpayer->id)
                    ->withError('¡La persona está registrada como representante de este contribuyente!');
            }
            
            return $this->registerRep($taxpayer, $person, $type);
        }

        $citizenship = $request->input('citizenship');
        return $this->createPerson($taxpayer, $type, $citizenship, $document);
    }

    public function registerRep(Taxpayer $taxpayer, Person $person, $type)
    {
        Representation::create([
            'person_id' => $person->id,
            'representation_type_id' => $type,
            'taxpayer_id' => $taxpayer->id
        ]);

        return redirect('taxpayers/'.$taxpayer->id)
                ->withSuccess('¡Representante registrado!');
    }

    public function createPerson(Taxpayer $taxpayer, $representationType, $citizenship, $document)
    {
        return view('modules.people.register')
            ->with('taxpayer', $taxpayer)
            ->with('representationTypes', RepresentationType::pluck('name', 'id'))
            ->with('type', $representationType)
            ->with('citizenships', Citizenship::pluck('description', 'id'))
            ->with('citizen', $citizenship)
            ->with('document', $document)
            ->with('typeForm', 'create');
    }

    public function storePerson(Request $request, Taxpayer $taxpayer)
    {
        $correlative = Citizenship::find($request->input('citizenship'))->correlative;
        $person = Person::create([
            'document' => $correlative.$request->input('document'),
            'first_name' => $request->input('first_name'),
            'second_name' => $request->input('second_name'),
            'surname' => $request->input('surname'),
            'second_surname' => $request->input('second_surname'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'citizenship_id' => $request->input('citizenship'),
        ]);
       
        return $this->registerRep($taxpayer, $person, $request->input('representation_type'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Representation  $Representation
     * @return \Illuminate\Http\Response
     */
    public function show(Representation $Representation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Representation  $Representation
     * @return \Illuminate\Http\Response
     */
    public function edit(Representation $Representation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Representation  $Representation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Representation $Representation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Representation  $Representation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Representation $Representation)
    {
        //
    }
}
