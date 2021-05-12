<?php

namespace App\Http\Controllers;

use App\Models\TaxpayerType;
use App\Models\TaxpayerClassification;
use App\Models\Taxpayer;
use App\Models\License;
use App\Models\State;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Http\Requests\Taxpayers\TaxpayerActivitiesFormRequest;
use App\Http\Requests\Taxpayers\TaxpayersCreateRequest;
use App\Http\Requests\Taxpayers\TaxpayersUpdateFormRequest;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class TaxpayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Taxpayer::latest();
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('rif', $filters)) {
                $query->whereLike('rif', $filters['rif']);
            }
            if (array_key_exists('name', $filters)) {
                $query->whereLike('name', $filters['name']);
            }
            if (array_key_exists('phone', $filters)) {
                $query->whereLike('phone', $filters['phone']);
            }
            if (array_key_exists('email', $filters)) {
                $query->whereLike('email', $filters['email']);
            }
            if (array_key_exists('address', $filters)) {
                $query->whereLike('fiscal_address', $filters['address']);
            }
            if (array_key_exists('taxpayer_type_id', $filters)) {
                $name = $filters['taxpayer_type_id'];

                $query->where('taxpayer_type_id', '=', $name);
            }
            if (array_key_exists('taxpayer_classification_id', $filters)) {
                $name = $filters['taxpayer_classification_id'];

                $query->where('taxpayer_classification_id', '=', $name);
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
    public function store(TaxpayersCreateRequest $request)
    {
        $type = $request->input('taxpayer_type_id');

        if (Taxpayer::existsRif($request->input('rif'))) {
            return redirect('taxpayers/create')
                ->withInput($request->input())
                ->withError('¡El RIF '.$request->input('rif').' se encuentra registrado!');
        }

        $taxpayer = Taxpayer::create($request->input());

        return redirect()->route('taxpayers.show', $taxpayer)
            ->withSuccess('¡Contribuyente registrado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taxpayer  $taxpayer
     * @return \Illuminate\Http\Response
     */
    public function show(Taxpayer $taxpayer)
    {
        $data = $taxpayer->load([
            'properties',
            'vehicles',
            'taxpayerType',
            'taxpayerClassification',
            'companies'
        ]);

        return response()->json($data, 200);
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

        return response()->json($taxpayer, 200);
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
