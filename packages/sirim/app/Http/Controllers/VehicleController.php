<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Color;
use App\Models\VehicleModel;
use App\Models\VehicleParameter;
use App\Models\VehicleClassification;
use App\Models\Taxpayer;
use App\Models\License;
use App\Models\Liquidation;
use App\Models\Payment;
use App\Models\Correlative;
use App\Models\CorrelativeType;
use App\Models\CorrelativeNumber;
use App\Models\Year;
use App\Models\Ordinance;
use App\Models\Concept;
use App\Models\PetroPrice;
use App\Models\Signature;
use Illuminate\Support\Facades\DB;
use PDF;
use Auth;

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

        //Cambiar a los datos del vehiculo, no los de la licencia

        if ($request->wantsJson()) {
            $query = Vehicle::query()->with(['color', 'vehicleModel', 'vehicleClassification','license', 'taxpayer']);

            return DataTables::eloquent($query)->toJson();
        }

        return view('modules.vehicles.index')
            ->with('taxpayer', Taxpayer::pluck('name', 'id'))
            ->with('color', Color::pluck('name', 'id'))
            ->with('vehicleClassification', VehicleClassification::pluck('name', 'id'))
            ->with('vehicleModel', VehicleModel::pluck('name', 'id'));

    }




    public function create(Taxpayer $taxpayer, Request $request)
    {
        if ($request->wantsJson()) {

            $query = Vehicle::whereTaxpayerId($taxpayer->id)->with(['color', 'vehicleModel', 'vehicleClassification','license', 'taxpayer']);

            return DataTables::eloquent($query)->toJson();
        }


        return view('modules.taxpayers.vehicles.index')
            ->with('taxpayer', $taxpayer)
            ->with('color', Color::pluck('name', 'id'))
            ->with('vehicleParameter', VehicleParameter::pluck('name', 'id'))
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
            'liquidable_type' => Vehicle::class,
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

        $vehicle = Vehicle::create([
            'plate' => $request->input('plate'),
            'body_serial' => $request->input('body_serial'),
            'engine_serial' => $request->input('engine_serial'),
            'weight' => $request->input('weight'),
            'capacity' => $request->input('capacity'),
            'stalls' => $request->input('stalls'),
            'taxpayer_id' => $taxpayer->id,
            'vehicle_model_id' =>  $request->input('vehicleModel'),
            'color_id' =>  $request->input('color'),
            'vehicle_classification_id' =>  $request->input('vehicleClassification'),
            'license_id' => $license->id
        ]);

        $liquidation->update([
            'liquidable_id' => $vehicle->id
        ]);

       return redirect('taxpayers/'.$taxpayer->id.'/vehicles')
           ->withSuccess('¡Patente de Vehículo creada!');
    }


    public function download(Vehicle $vehicle)
    {
        $taxpayer = $vehicle->taxpayer;

        $num = preg_replace("/[^0-9]/", "", $taxpayer->rif);

        $license= License::whereId($vehicle->license_id)->first();

        $correlative = $license->correlative;
        $licenseCorrelative = $correlative->correlativeType->description.
                             $correlative->year->year.'-'
                             .$correlative->correlativeNumber->num;

        $representation = $license->representation->person;
        $signature = Signature::latest()->first();


        $liquidation = Liquidation::whereId($license->liquidation_id)->first();

        $period =Carbon::createFromDate($license->create_at)->format('Y').'-'.Carbon::createFromDate($license->expiration_date)->format('Y');

        $liquidationPayment = DB::table('payment_liquidation')->where('liquidation_id', $liquidation->id)->first();

        $payment = Payment::whereId($liquidationPayment->payment_id)->first();

        $paymentDate = str_replace('/', '-', $payment->processed_at);

        $processedAt =Carbon::createFromDate($paymentDate)->format('d-m-Y');


        $qrLicenseString = 'Nº: '.$license->num.', Registro: '.$num.', Empresa:'.$taxpayer->name;

        $vars = ['license', 'taxpayer', 'num', 'representation', 'licenseCorrelative', 'signature', 'qrLicenseString', 'vehicle', 'payment', 'liquidation', 'processedAt', 'period'];
        $license->update(['downloaded_at' => Carbon::now()]);

        return PDF::loadView('modules.vehicles.pdf.vehicle-license', compact($vars))
            ->stream('Licencia '.$license->num.'.pdf');
    }


    public function listClassifications(VehicleParameter $vehicleParameter)
    {

        $query= VehicleClassification::where('vehicle_parameter_id', $vehicleParameter->id)->get();

        return $query;

        //return $vehicleParameter->classificationsByList($vehicleParameter->id);
    }
}
