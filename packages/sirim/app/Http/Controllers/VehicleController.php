<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Color;
use App\Models\VehicleModel;
use App\Models\VehicleClassification;
use App\Models\Taxpayer;
use App\Models\License;
use App\Models\CorrelativeType;
//use App\Models\RequirementTaxpayer
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = License::where('ordinance_id', '4');

        if ($request->wantsJson()) {
            $query->with(['taxpayer', 'ordinance']);

            return DataTables::eloquent($query)->toJson();
        }

        return view('modules.vehicles.index');

    }




    public function create(Taxpayer $taxpayer, Request $request)
    {
        if ($request->wantsJson()) {

            $licenses = License::whereTaxpayerId($taxpayer->id)->where('ordinance_id', '4')->with("vehicles")->get();

            foreach($licenses as $license){

               $vehicle = Vehicle::whereLicenseId($license->id)->first();

                if($vehicle){

                   $liquidation = $vehicle->liquidations->first();

                   if ($license->active == false) {

                       if($liquidation->status_id == 2){

                            $license->update([
                                'active' => true
                            ]);
                        }
                    }
                }
            }

            $query = License::whereTaxpayerId($taxpayer->id)->where('ordinance_id', '4');

            //->where('active', true)

            return DataTables::eloquent($query)->toJson();
        }

        $correlatives = [
            1 => 'INSTALAR PATENTE',
            2 => 'RENOVAR PATENTE'
        ];


        $existingLicenses = License::whereTaxpayerId($taxpayer->id)->where('ordinance_id', '6')->pluck('num', 'id')->toArray();


        $boolean = [
            true => 'Si',
            false => 'No'
        ];


        return view('modules.taxpayers.vehicles.index')
            ->with('taxpayer', $taxpayer)
            ->with('correlatives', $correlatives)
            ->with('boolean', $boolean)
            ->with('existingLicenses', $existingLicenses)
            ->with('color', Color::pluck('name', 'id'))
            ->with('vehicleClassification', VehicleClassification::pluck('name', 'id'))
            ->with('vehicleModel', VehicleModel::pluck('name', 'id'));
    }




    public function store(Request $request, Taxpayer $taxpayer)
    {
       $correlative = CorrelativeType::find($request->input('correlative'));

       if($correlative->id == 1){
           $this->make($request, $correlative, $taxpayer);
       }else{
           $this->renovate($request, $correlative, $taxpayer);
       }


       return redirect('taxpayers/'.$taxpayer->id.'/vehicles')
           ->withSuccess('¡Patente de Vehículo creada!');
    }




    public function show(Vehicle $vehicle)
    {
        //
    }


    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }


    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
