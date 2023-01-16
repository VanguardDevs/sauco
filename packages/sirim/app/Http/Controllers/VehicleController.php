<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Color;
use App\Models\Brand;
use App\Models\VehicleModel;
use App\Models\VehicleParameter;
use App\Models\VehicleClassification;
use App\Models\VehicleCorrelative;
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

use App\Http\Requests\Vehicles\VehicleCreateFormRequest;
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
            $query = Vehicle::query()->with(['color', 'license', 'vehicleModel', 'vehicleClassification', 'license.liquidation','taxpayer']);


            /*->join('licenses', 'licenses.id', '=', 'vehicles.license_id')
            ->join('liquidations', 'licenses.liquidation_id', '=', 'liquidations.id')
            ->join('vehicle_models', 'vehicle_models.id', '=', 'vehicles.vehicle_model_id')
            ->join('vehicle_classifications', 'vehicle_classifications.id', '=', 'vehicles.vehicle_classification_id');*/


            return DataTables::eloquent($query)->toJson();
        }

        return view('modules.vehicles.index');

    }




    public function create(Taxpayer $taxpayer, Request $request)
    {
        if ($request->wantsJson()) {

            $query = Vehicle::whereTaxpayerId($taxpayer->id)->with(['color', 'vehicleModel', 'vehicleClassification','license', 'taxpayer', 'license.liquidation']);

            return DataTables::eloquent($query)->toJson();
        }


        return view('modules.taxpayers.vehicles.index')
            ->with('taxpayer', $taxpayer)
            ->with('color', Color::pluck('name', 'id'))
            ->with('vehicleParameter', VehicleParameter::pluck('name', 'id'))
            ->with('vehicleBrand', Brand::pluck('name', 'id'));
    }




    public function store(VehicleCreateFormRequest $request, Taxpayer $taxpayer)
    {
        $currYear = Year::where('year', Carbon::now()->year)->first();

        $correlativeNum = CorrelativeNumber::getNum();

        $ordinance = Ordinance::whereId('4')->first();
        $emissionDate = Carbon::now();
        $expirationDate = Carbon::now()->endOfYear();

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


        $vehicleCorrelativeNum = VehicleCorrelative::getNewNum();

        $vehicleCorrelative = VehicleCorrelative::create([
            'num' => $vehicleCorrelativeNum,
            'year_id' => $currYear->id
        ]);


        $liquidation = Liquidation::create([
            'num' => Liquidation::getNewNum(),
            'object_payment' =>  $concept->name.' - AÑO '.$currYear->year,
            'amount' => $amount,
            'liquidable_type' => Vehicle::class,
            'concept_id' => $concept->id,
            'liquidation_type_id' => 1,
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
            //'num' => $request->input('plate'),

            'num' => $vehicleCorrelative->number,
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
            'license_id' => $license->id,
            'status' => false
        ]);

        $vehicleCorrelative->update([
            'license_id' => $license->id
        ]);

        $liquidation->update([
            'liquidable_id' => $vehicle->id
        ]);

       return redirect('taxpayers/'.$taxpayer->id.'/vehicles')
           ->withSuccess('¡Patente de Vehículo creada!');
    }





    public function renovate(Vehicle $vehicle)
    {
        $currYear = Year::where('year', Carbon::now()->year)->first();
        $emissionDate = Carbon::now();
        $expirationDate = Carbon::now()->endOfYear();

        $oldLicense = $vehicle->license;

        $taxpayer = $vehicle->taxpayer;

        $concept = Concept::whereCode('15')->first();

        $petro = PetroPrice::latest()->first()->value;

        $vehicleClassification = $vehicle->vehicleClassification;

        $amount = $petro*$vehicleClassification->amount;


        $correlative = $oldLicense->correlative;
        $correlativeNumber = $correlative->correlativeNumber;


        $liquidation = Liquidation::create([
            'num' => Liquidation::getNewNum(),
            'object_payment' =>  $concept->name.' - AÑO '.$currYear->year,
            'amount' => $amount,
            'liquidable_type' => Vehicle::class,
            'concept_id' => $concept->id,
            'liquidation_type_id' => 1,
            'liquidable_id' => $vehicle->id,
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


        $newCorrelative = Correlative::create([
            'correlative_type_id' => 2,
            'correlative_number_id' => $correlativeNumber->id,
            'year_id' => $currYear->id
        ]);

        $vehicleCorrelative = VehicleCorrelative::whereLicenseId($oldLicense->id)->first();

        $newLicense = License::create([
            'num' => 'MBES'.$currYear->year.'IV-'.$vehicleCorrelative->num,
            'emission_date' => $emissionDate,
            'expiration_date' => $expirationDate,
            'ordinance_id' => $oldLicense->ordinance_id,
            'correlative_id' => $newCorrelative->id,
            'taxpayer_id' => $taxpayer->id,
            'representation_id' => $taxpayer->president()->first()->id,
            'user_id' => Auth::user()->id,
            'active' => false,
            'liquidation_id' => $liquidation->id
        ]);


        $oldLicense->update([
            'active' => false
        ]);

        $vehicleCorrelative->update([
            'license_id' => $newLicense->id
        ]);

        $vehicle->update([
            'license_id' => $newLicense->id
        ]);


        return redirect('taxpayers/'.$taxpayer->id.'/vehicles')
           ->withSuccess('¡Patente de Vehículo renovada!');    }





    public function download(Vehicle $vehicle)
    {
        $taxpayer = $vehicle->taxpayer;

        $num = preg_replace("/[^0-9]/", "", $taxpayer->rif);

        $license= License::whereId($vehicle->license_id)->first();

        $vehicleCorrelative = VehicleCorrelative::whereLicenseId($license->id)->first();

        $numVehicleCorrelative = $vehicleCorrelative->number;

        $representation = $license->representation->person;
        $signature = Signature::latest()->first();
        $period =Carbon::createFromDate($license->created_at)->format('Y');

        if($license->liquidation_id){
            $liquidation = Liquidation::whereId($license->liquidation_id)->first();

            $liquidationPayment = DB::table('payment_liquidation')->where('liquidation_id', $liquidation->id)->first();

            $payment = Payment::whereId($liquidationPayment->payment_id)->first();

            $paymentDate = str_replace('/', '-', $payment->processed_at);

            $processedAt =Carbon::createFromDate($paymentDate)->format('d-m-Y');

            $paymentNum = $payment->num;

        }
        else{
            $paymentNum = null;

            $processedAt =Carbon::createFromDate($license->create_at)->format('d-m-Y');
        }

        $qrLicenseString = 'Nº: '.$license->num.', Registro: '.$num.', Empresa:'.$taxpayer->name;

        $vars = ['license', 'taxpayer', 'num', 'representation', 'signature', 'qrLicenseString', 'vehicle', 'paymentNum', 'processedAt', 'period', 'numVehicleCorrelative'];
        $license->update(['downloaded_at' => Carbon::now()]);

        return PDF::loadView('modules.vehicles.pdf.vehicle-license', compact($vars))
            ->stream('Patente '.$license->num.'.pdf');
    }





    public function ticket(Vehicle $vehicle)
    {

            $taxpayer = $vehicle->taxpayer;

            $num = preg_replace("/[^0-9]/", "", $taxpayer->rif);

            $license= License::whereId($vehicle->license_id)->first();

            $vehicleCorrelative = VehicleCorrelative::whereLicenseId($license->id)->first();

            $numVehicleCorrelative = $vehicleCorrelative->number;

            if($license->liquidation_id){
                $liquidation = Liquidation::whereId($license->liquidation_id)->first();

                $liquidationPayment = DB::table('payment_liquidation')->where('liquidation_id', $liquidation->id)->first();

                $payment = Payment::whereId($liquidationPayment->payment_id)->first();

                $paymentDate = str_replace('/', '-', $payment->processed_at);

                $processedAt =Carbon::createFromDate($paymentDate)->format('d-m-Y');

                $paymentNum = $payment->num;

            }
            else{
                $paymentNum = null;

                $processedAt =Carbon::createFromDate($license->create_at)->format('d-m-Y');
            }

            $representation = $license->representation->person;
            $signature = Signature::latest()->first();

            $period =Carbon::createFromDate($license->created_at)->format('Y');

            $customPaper = array(0,0,228,300);
            $vars = ['license', 'taxpayer', 'num', 'representation', 'signature', 'vehicle', 'period', 'numVehicleCorrelative', 'paymentNum', 'processedAt'];

            return PDF::setOptions(['isRemoteEnabled' => true])
                ->loadView('modules.vehicles.pdf.vehicle-ticket', compact($vars))
                ->setPaper($customPaper)
                ->stream('vehiculo-ticket-'.$license->num.'.pdf');

   }


   public function certificate(Vehicle $vehicle)
   {

           $taxpayer = $vehicle->taxpayer;

           $num = preg_replace("/[^0-9]/", "", $taxpayer->rif);

           $license= License::whereId($vehicle->license_id)->first();

           $vehicleCorrelative = VehicleCorrelative::whereLicenseId($license->id)->first();

           $numVehicleCorrelative = $vehicleCorrelative->number;

           if($license->liquidation_id){
               $liquidation = Liquidation::whereId($license->liquidation_id)->first();

               $liquidationPayment = DB::table('payment_liquidation')->where('liquidation_id', $liquidation->id)->first();

               $payment = Payment::whereId($liquidationPayment->payment_id)->first();

               $paymentDate = str_replace('/', '-', $payment->processed_at);

               $processedAt =Carbon::createFromDate($paymentDate)->format('d-m-Y');

               $paymentNum = $payment->num;

           }
           else{
               $paymentNum = null;

               $processedAt =Carbon::createFromDate($license->create_at)->format('d-m-Y');
           }

           $representation = $license->representation->person;
           $signature = Signature::latest()->first();

           $period =Carbon::createFromDate($license->created_at)->format('Y');

           $customPaper = array(0,0,243,155);
           $vars = ['license', 'taxpayer', 'num', 'representation', 'signature', 'vehicle', 'period', 'numVehicleCorrelative', 'paymentNum', 'processedAt'];

           return PDF::setOptions(['isRemoteEnabled' => true])
               ->loadView('modules.vehicles.pdf.vehicle-certificate', compact($vars))
               ->stream('vehiculo-certificado-'.$license->num.'.pdf');

    }


    public function listClassifications(VehicleParameter $vehicleParameter)
    {
        return $vehicleParameter->classificationsByList($vehicleParameter->id);
    }

    public function listModels(Brand $vehicleBrand)
    {
        return $vehicleBrand->modelsByList($vehicleBrand->id);
    }



    /** Create Vehicle without liquidation */
    public function add(Taxpayer $taxpayer, Request $request)
    {
        if ($request->wantsJson()) {

            $query = Vehicle::whereTaxpayerId($taxpayer->id)->with(['color', 'vehicleModel', 'vehicleClassification','license', 'taxpayer', 'license.liquidation']);

            return DataTables::eloquent($query)->toJson();
        }

        return view('modules.taxpayers.vehicles.add')
            ->with('taxpayer', $taxpayer)
            ->with('color', Color::pluck('name', 'id'))
            ->with('vehicleParameter', VehicleParameter::pluck('name', 'id'))
            ->with('vehicleBrand', Brand::pluck('name', 'id'));
    }


    public function save(VehicleCreateFormRequest $request, Taxpayer $taxpayer)
    {

        $currYear = Year::where('year', Carbon::now()->year)->first();
        $correlativeNum = CorrelativeNumber::getNum();

        $ordinance = Ordinance::whereId('4')->first();
        $emissionDate = Carbon::now();
        $expirationDate = Carbon::now()->endOfYear();


        $correlativeNumber = CorrelativeNumber::create([
            'num' => $correlativeNum
        ]);

        $correlative = Correlative::create([
            'year_id' => $currYear->id,
            'correlative_type_id' => 1,
            'correlative_number_id' => $correlativeNumber->id
        ]);



        $vehicleCorrelativeNum = VehicleCorrelative::getNewNum();

        $vehicleCorrelative = VehicleCorrelative::create([
            'num' => $vehicleCorrelativeNum,
            'year_id' => $currYear->id
        ]);


        /** TU DIJISTE QUE EL correlative_id SE QUEDABA ASÍ */
        $license = License::create([
            'num' => $vehicleCorrelative->number,
            'emission_date' => $emissionDate,
            'expiration_date' => $expirationDate,
            'ordinance_id' => $ordinance->id,
            'correlative_id' => $correlative->id,
            'taxpayer_id' => $taxpayer->id,
            'representation_id' => $taxpayer->president()->first()->id,
            'user_id' => Auth::user()->id,
            'active' => true
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
            'license_id' => $license->id,
            'status' => true
        ]);

        $vehicleCorrelative->update([
            'license_id' => $license->id
        ]);


       return redirect('taxpayers/'.$taxpayer->id.'/vehicles/only-add')
           ->withSuccess('¡Patente de Vehículo creada!');
    }
}
