<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Color;
use App\Models\VehicleModel;
use App\Models\VehicleClassification;
use App\Models\Taxpayer;
use App\Models\License;
use App\Models\Liquidation;
use App\Models\Payment;
use App\Models\CorrelativeType;
use App\Models\CorrelativeNumber;
use App\Models\Year;
use App\Models\Ordinance;
use App\Models\Concept;
use App\Models\PetroPrice;

//use App\Models\Requirement;
//use App\Models\RequirementTaxpayer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

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

        //Cambiar a los datos del vehiculo, no los de la licencia

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


        $existingLicenses = License::whereTaxpayerId($taxpayer->id)->where('ordinance_id', '6')->pluck('num', 'id')->toArray();


        return view('modules.taxpayers.vehicles.index')
            ->with('taxpayer', $taxpayer)
            ->with('existingLicenses', $existingLicenses)
            ->with('color', Color::pluck('name', 'id'))
            ->with('vehicleClassification', VehicleClassification::pluck('name', 'id'))
            ->with('vehicleModel', VehicleModel::pluck('name', 'id'));
    }




    public function store(Request $request, Taxpayer $taxpayer)
    {
        $currYear = Year::where('year', Carbon::now()->year)->first();
        $correlativeNum = CorrelativeNumber::getNum();

        $ordinance = Ordinance::whereDescription('VEHÍCULOS')->first();
        $emissionDate = Carbon::now();
        $expirationDate = $emissionDate->copy()->addYears(1);

        $concept = Concept::whereCode('15')->first();

        $petro = PetroPrice::latest()->first()->value;

        $idClassification = $request->input('vehicleClassification');

        $vehicleClassification = VehicleClassification::whereId($idClassification)->first();

        $amount = $petro*$vehicleClassification->amount;

        $correlativeNumber = CorrelativeNumber::create([
            'num' => $correlativeNum
        ]);

        $correlative = Correlative::create([
            'year_id' => $currYear->id,
            'correlative_type_id' => 1,
            'correlative_number_id' => $correlativeNumber->id
        ]);

        $liquidation = Liquidation::create([
            'num' => Liquidation::getNewNum(),
            'object_payment' =>  $concept->name.' - AÑO '.$currYear->year,
            'amount' => $amount,
            'liquidable_type' => Liquidation::class,
            'concept_id' => $concept->id,
            'liquidation_type_id' => $concept->liquidation_type_id,
            'status_id' => 1,
            'taxpayer_id' => $taxpayer->id
        ]);

        $payment = Payment::create([
            'status_id' => 1,
            'user_id' => Auth::user()->id,
            'amount' => $amount,
            'payment_method_id' => 1,
            'payment_type_id' => 1,
            'taxpayer_id' => $taxpayer->id
        ]);

        $payment->liquidations()->sync($liquidation);


        /** TU DIJISTE QUE EL correlative_id SE QUEDABA ASÍ */
        $license = License::create([
            'num' => $request->input('plate'),
            'emission_date' => $emissionDate,
            'expiration_date' => $expirationDate,
            'ordinance_id' => $ordinance->id,
            'correlative_id' => $correlative->id,
            'taxpayer_id' => $taxpayer->id,
            'representation_id' => $taxpayer->president()->first()->id,
            'user_id' => Auth::user()->id,
            'active' => false,
            'liquidation_id' => $liquidation->id
        ]);

        $liqueur = Vehicle::create([
            'plate' => $request->input('plate'),
            'body_serial' => $request->input('body_serial'),
            'engine_serial' => $request->input('engine_serial'),
            'status'  => $request->input('status'),
            'weight' => $request->input('weight'),
            'capacity' => $request->input('capacity'),
            'stalls' => $request->input('stalls'),
            'taxpayer_id' => $taxpayer->id,
            'vehicle_model_id' =>  $request->input('vehicleModel'),
            'color_id' =>  $request->input('color'),
            'vehicle_classification_id' =>  $request->input('vehicleClassification'),
            'license_id' => $license->id
        ]);

       return redirect('taxpayers/'.$taxpayer->id.'/vehicles')
           ->withSuccess('¡Patente de Vehículo creada!');
    }


    public function makeLicense($request, CorrelativeType $type, Taxpayer $taxpayer)
    {


    }

}
