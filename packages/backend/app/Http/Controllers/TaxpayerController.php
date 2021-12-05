<?php

namespace App\Http\Controllers;

use App\Models\Taxpayer;
use Illuminate\Http\Request;
use App\Http\Requests\TaxpayersCreateRequest;
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
            if (array_key_exists('community_id', $filters)) {
                $name = $filters['community_id'];

                $query->where('community_id', '=', $name);
            }
            if (array_key_exists('id', $filters)) {
                $query->find($filters['id']);
            }
        }

        if ($request->type == 'pdf') {
            return $this->report($query);
        }

        return $query->paginate($results);
    }

    public function report($query)
    {
        // Prepare pdf
        $models = $query->get();
        $title = "Padrón de contribuyentes";

        $pdf = PDF::LoadView('pdf.reports.taxpayers', compact([
            'models',
            'title'
        ]));

        return $pdf->download();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaxpayersCreateRequest $request)
    {
        $taxpayer = Taxpayer::create($request->all());

        return response()->json($taxpayer, 200);
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
            'taxpayerType',
            'taxpayerClassification',
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
    public function update(TaxpayersCreateRequest $request, Taxpayer $taxpayer)
    {
        $taxpayer->update($request->all());

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
