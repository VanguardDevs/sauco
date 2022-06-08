<?php

namespace App\Http\Controllers;

use App\Models\LiqueurParameter;
use App\Models\LiqueurClassification;
use App\Models\LiqueurZone;
use App\Models\ChargingMethod;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class LiqueurParameterController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(LiqueurParameter $liqueurParameter)
    {
        return view('modules.liqueur-parameters.index');
            /*->with('taxpayer', $taxpayer)
            ->with('ordinances', Ordinance::pluck('description', 'id'));*/
    }


    public function list()
    {
        $query = LiqueurParameter::query() ->with(['liqueur_classification', 'liqueur_zone', 'charging_method']);;

        return DataTables::eloquent($query)->toJson();
    }


    public function create(LiqueurParameter $liqueurParameter)
    {
        return view('modules.liqueur-parameters.register')
        ->with('liqueurClassification', LiqueurClassification::pluck('name', 'id'))
        ->with('liqueurZone', LiqueurZone::pluck('name', 'id'))
        ->with('chargingMethod', ChargingMethod::pluck('name', 'id'))
        ->with('liqueurParameter', $liqueurParameter)
            ->with('typeForm', 'create');
    }



    public function store(LiqueurParameterCreateFormRequest $request)
    {
        $create = LiqueurParameter::create([
            'description' => $request->input('description'),
            'new_registry_amount' => $request->input('new_registry_amount'),
            'renew_registry_amount' => $request->input('renew_registry_amount'),
            'authorization_registry_amount' => $request->input('authorization_registry_amount'),
            'is_mobile' => $request->input('is_mobile'),
            'liqueur_classification_id' => $request->input('liqueur_classification_id'),
            'liqueur_zone_id' => $request->input('liqueur_zone_id'),
            'charging_method_id' => $request->input('charging_method_id')
        ]);


        return redirect('liqueur-parameters')
            ->withSuccess('¡Parametro de Expendio Registrado!');
    }


    public function edit(LiqueurParameter $liqueurParameter)
    {
        return view('modules.liqueur-parameters.register')
            ->with('liqueurClassification', LiqueurClassification::pluck('name', 'id'))
            ->with('liqueurZone', LiqueurZone::pluck('name', 'id'))
            ->with('chargingMethod', ChargingMethod::pluck('name', 'id'))
            ->with('liqueurParameter', $liqueurParameter)
            ->with('typeForm', 'update')
            ->with('row', $liqueurParameter);
    }


    public function update(LiqueurParameterUpdateFormRequest $request, LiqueurParameter $liqueurParameter)
    {
        $edit = LiqueurParameter::find($liqueurParameter->id);
        $edit->fill($request->all())
            ->save();

        return redirect('liqueur-parameters')
            ->withSuccess('¡Parametro de Expendio actualizado!');

    }



}
