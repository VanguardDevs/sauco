<?php

namespace App\Http\Controllers;

use App\CommercialDenomination;
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
        $query = Taxpayer::orderBy('id', 'DESC');

        return DataTables::eloquent($query)->toJson();
    }

    public function getRepresentations(Taxpayer $taxpayer)
    {
        $query = $taxpayer->representations()->with(['representationType', 'person']);

        return response()->json($query->get());
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
        $denomination = $request->input('personal_firm');

        if (Taxpayer::existsRif($request->input('rif'))) {
            return redirect('taxpayers/create')
                ->withInput($request->input())
                ->withError('¡El RIF '.$request->input('rif').' se encuentra registrado!');
        }

        if ($type != 1 && empty($denomination)) {
            return redirect()->route('taxpayers.create')
                ->withInput($request->input())
                ->withError('¡Ingrese la denominación comercial!');
        }

        $taxpayer = Taxpayer::create($request->input());

        if (!empty($denomination)) {
            CommercialDenomination::create([
                'name' => $denomination,
                'taxpayer_id' => $taxpayer->id
            ]);
        }

        return redirect()->route('taxpayers.show', $taxpayer)
            ->withSuccess('¡Contribuyente registrado!');
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
    public function show(Taxpayer $taxpayer)
    {
        return view('modules.taxpayers.show')
            ->with('row', $taxpayer);
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
