<?php

namespace App\Http\Controllers;

use App\Company;
use App\EconomicActivity;
use App\TaxpayerType;
use App\TaxpayerClassification;
use App\Person;
use App\Taxpayer;
use App\License;
use App\Community;
use Illuminate\Http\Request;
use App\Http\Requests\Taxpayers\TaxpayerActivitiesFormRequest;
use App\Http\Requests\Taxpayers\TaxpayersCreateFormRequest;
use App\Http\Requests\Taxpayers\TaxpayersUpdateFormRequest;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class TaxpayerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create.taxpayers')->only(['create','store']);
        $this->middleware('can:edit.taxpayers')->only(['edit', 'update']);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numPersons = Person::get()->count();
        $numLicenses = License::get()->count();

        return view('modules.taxpayers.index')
            ->with('numPersons', $numPersons)
            ->with('numLicenses', $numLicenses);
    }

    public function list()
    {
        $query = Taxpayer::query();

        return DataTables::eloquent($query)->toJson();
    }

    public function getRepresentations(Taxpayer $taxpayer)
    {
        $query = $taxpayer->representations()->with(['representationType', 'person']);

        return response()->json($query->get());
    }

    public function economicActivities(Taxpayer $taxpayer)
    {
        $query = $taxpayer->economicActivities;

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.taxpayers.register')
            ->with('types', TaxpayerType::pluck('description', 'id'))
            ->with('classifications', TaxpayerClassification::pluck('name', 'id'))
            ->with('communities', Community::pluck('name', 'id'))
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
        $type = $request->input('taxpayer_type_id');

        if (Taxpayer::existsRif($request->input('rif'))) {
            return redirect('taxpayers/create')
                ->withInput($request->input())
                ->withError('¡El RIF '.$request->input('rif').' se encuentra registrado!');
        }

        $taxpayer = Taxpayer::create($request->input());

        $this->createCompany($taxpayer);

        return redirect()->route('taxpayers.show', $taxpayer)
            ->withSuccess('¡Contribuyente registrado!');
    }

    /**
    * Creates a company if taxpayer is juridical
     */     
    public function createCompany($taxpayer)
    {
        if ($taxpayer->taxpayerType->description == 'JURÍDICO') {
            $taxpayer->companies()->create([
                'name' => $taxpayer->name
            ]);
        }
    }

    public function downloadDeclarations(Taxpayer $taxpayer)
    {
        $denomination = (!!$taxpayer->commercialDenomination) ? $taxpayer->commercialDenomination->name : $taxpayer->name;
        $settlements = $taxpayer->settlements;

        $pdf = PDF::LoadView('modules.taxpayers.pdf.declarations', compact(['taxpayer', 'denomination', 'settlements']));
        return $pdf->stream('Contribuyente '.$taxpayer->rif.'.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taxpayer  $taxpayer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Taxpayer $taxpayer)
    {
        if ($request->wantsJson()) {
            return $taxpayer;
        }

        return view('modules.taxpayers.show')
            ->with('row', $taxpayer);
    }

    public function showPayments(Taxpayer $taxpayer)
    {
        $query = $taxpayer->payments()->with(['state', 'user'])
            ->whereTaxpayerId($taxpayer->id)
            ->orderBy('id', 'DESC');
        
        return $query->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taxpayer  $taxpayer
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxpayer $taxpayer)
    {
        return view('modules.taxpayers.register')
            ->with('classifications', TaxpayerClassification::pluck('name', 'id'))
            ->with('types', TaxpayerType::pluck('description', 'id'))
            ->with('communities', Community::pluck('name', 'id'))
            ->with('typeForm', 'edit')
            ->with('row', $taxpayer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taxpayer  $taxpayer
     * @return \Illuminate\Http\Response
     */
    public function update(TaxpayersUpdateFormRequest $request, Taxpayer $taxpayer)
    {
        $taxpayer->update($request->input());

        if ($request->input('persona_firm')) {
            $taxpayer->commercialDenomination->name = $request->input('personal_firm');
            $taxpayer->push();
        }

        return redirect('taxpayers/'.$taxpayer->id)
            ->withSuccess('¡Info. general del contribuyente actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Taxpayer  $taxpayer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taxpayer $taxpayer)
    {
        //
    }
}
