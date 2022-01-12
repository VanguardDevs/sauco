<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Builder;
use PDF;
use Auth;
use App\Models\License;
use App\Models\Correlative;
use App\Models\CorrelativeNumber;
use App\Models\CorrelativeType;
use App\Models\Year;
use App\Models\Ordinance;
use App\Models\Taxpayer;
use App\Models\App\Modelslication;
use Carbon\Carbon;
use App\Models\Signature;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ordinance = $request->get('ordinance');
        $type = $request->get('type');
        $pdf = $request->get('pdf');
        $from = $request->get('from');
        $to = $request->get('to');

        $query = License::orderBy('created_at', 'DESC');

        if ($ordinance) {
            $query->whereOrdinanceId($ordinance);
        }
        if ($type) {
            $query->whereHas('correlative', function (Builder $query) use ($type) {
                $query->whereCorrelativeTypeId($type);
            });
        }
        if ($from) {
            $query->whereBetween('emission_date',  [$from, $to]);
        }

        // Return responses
        if ($request->wantsJson()) {
            $query->with(['taxpayer', 'ordinance'])
                ->orderBy('created_at', 'DESC');

            return DataTables::eloquent($query)->toJson();
        }

        if ($pdf) {
            return $this->printReport($query);
        }

        return view('modules.licenses.index');
    }

    /**
     * Print a pdf of all licenses
     *
     * Return PDF
     */
    private function printReport($query)
    {
        $licenses = $query->get();
        $total = $query->count();
        $emissionDate = date('d-m-Y', strtotime(Carbon::now()));

        $data = compact(['licenses', 'emissionDate', 'total']);
        $pdf = PDF::loadView('modules.reports.pdf.licenses', $data);

        return $pdf->download('licencias-emitidas-'.$emissionDate.'.pdf');
    }

    public function listBytaxpayer(Taxpayer $taxpayer)
    {
        $query = License::whereTaxpayerId($taxpayer->id);

    	return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Taxpayer $taxpayer, Request $request)
    {
        if ($request->wantsJson()) {
            $query = License::whereTaxpayerId($taxpayer->id);

            return DataTables::eloquent($query)->toJson();
        }

        $correlatives = [
            1 => 'INSTALAR LICENCIA',
            2 => 'RENOVAR LICENCIA'
        ];

        return view('modules.taxpayers.economic-activity-licenses.index')
            ->with('taxpayer', $taxpayer)
            ->with('correlatives', $correlatives);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Taxpayer $taxpayer)
    {
        $correlative = CorrelativeType::find($request->input('correlative'));

        $validator = $this->validateStore($taxpayer, $correlative);

        if ($validator['error']) {
            return redirect()->back()->withError($validator['msg']);
        }

        $this->makeLicense($correlative, $taxpayer);

        return redirect('taxpayers/'.$taxpayer->id.'/economic-activity-licenses')
            ->withSuccess('¡Licencia de actividad económica creada!');
    }

    public function makeLicense(CorrelativeType $type, Taxpayer $taxpayer)
    {
        $currYear = Year::where('year', Carbon::now()->year)->first();
        $correlativeNum = CorrelativeNumber::getNum();
        // Maybe for other kind of licenses, I would inject
        // Ordinances in this method and make licences without searching for
        // a model
        $ordinance = Ordinance::whereDescription('ACTIVIDADES ECONÓMICAS')->first();
        $emissionDate = Carbon::now();
        $expirationDate = $emissionDate->copy()->endOfYear();

        $correlativeNumber = CorrelativeNumber::create([
            'num' => $correlativeNum
        ]);

        $correlative = Correlative::create([
            'year_id' => $currYear->id,
            'correlative_type_id' => $type->id,
            'correlative_number_id' => $correlativeNumber->id
        ]);

        $license = License::create([
            'num' => $correlative->num,
            'emission_date' => $emissionDate,
            'expiration_date' => $expirationDate,
            'ordinance_id' => $ordinance->id,
            'correlative_id' => $correlative->id,
            'taxpayer_id' => $taxpayer->id,
            'representation_id' => $taxpayer->president()->first()->id,
            'user_id' => Auth::user()->id
        ]);

        // Sync economic activities
        $act = $taxpayer->economicActivities;
        $license->economicActivities()->sync($act);
    }

    public function renovate(License $license)
    {
        $currYear = Year::where('year', Carbon::now()->year)->first();
        // Maybe for other kind of licenses, I would inject
        // Ordinances in this method and make licences without searching for
        // a model
        $ordinance = Ordinance::whereDescription('ACTIVIDADES ECONÓMICAS')->first();
        $emissionDate = Carbon::now();
        $expirationDate = $emissionDate->copy()->addYears(1);

        $correlative = $license->correlative;
        $correlativeNumber = $correlative->correlativeNumber;
        $newCorrelative = Correlative::create([
            'correlative_type_id' => 2,
            'correlative_number_id' => $correlativeNumber->id,
            'year_id' => $currYear->id
        ]);

        $newLicense = License::create([
            'num' => $newCorrelative->num,
            'emission_date' => $emissionDate,
            'expiration_date' => $expirationDate,
            'ordinance_id' => $ordinance->id,
            'correlative_id' => $newCorrelative->id,
            'taxpayer_id' => $license->taxpayer->id,
            'representation_id' => $license->taxpayer->president()->first()->id,
            'user_id' => Auth::user()->id
        ]);
        // Sync economic activities
        $act = $newLicense->taxpayer->economicActivities;
        $newLicense->economicActivities()->sync($act);

        $license->delete();

        return response()->json($newLicense);
    }

    public function validateStore(Taxpayer $taxpayer, $correlativeType)
    {
        $isValid = [
            'error' => false,
            'msg' => ''
        ];

        if (!$taxpayer->economicActivities->count()) {
           $isValid['error'] = true;
           $isValid['msg'] = '¡El contribuyente no tiene actividades económicas!';
        }

        if (!$taxpayer->president()->count()) {
            $isValid['error'] = true;
            $isValid['msg'] = '¡El contribuyente no tiene un representante (PRESIDENTE) registrado!';
        }

        if ($taxpayer->licenses()->exists()) {
            $isValid['error'] = true;
            $isValid['msg'] = '¡El contribuyente tiene una licencia activa!';
        }

        return $isValid;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Taxpayer $taxpayer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, License $license)
    {
        if ($request->wantsJson()) {
            $data = $license->load(
                'user',
                'taxpayer',
                'representation.person',
                'ordinance',
            );

            if ($license->ordinance->description == 'ACTIVIDADES ECONÓMICAS') {
                $data->load('economicActivities');
            }

            return response()->json($data);
        }
        return view('modules.licenses.show')
            ->with('row', $license);
    }

    public function download(License $license)
    {
        $taxpayer = $license->taxpayer;
        $num = preg_replace("/[^0-9]/", "", $taxpayer->rif);
        $correlative = $license->correlative;
        $licenseCorrelative = $correlative->correlativeType->description.
                             $correlative->year->year.'-'
                             .$correlative->correlativeNumber->num;

        $representation = $license->representation->person->name;
        $signature = Signature::latest()->first();
        $qrLicenseString = 'Nº: '.$license->num.', Registro: '.$num.', Empresa:'.$taxpayer->name;

        $vars = ['license', 'taxpayer', 'num', 'representation', 'licenseCorrelative', 'signature', 'qrLicenseString'];
        $license->update(['downloaded_at' => Carbon::now(), 'user_id' => Auth::user()->id]);

        return PDF::loadView('modules.licenses.pdf.economic-activity-license', compact($vars))
            ->download('Licencia '.$taxpayer->rif.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\License  $License
     * @return \Illuminate\Http\Response
     */
    public function edit(License $License)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\License  $License
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, License $License)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\License  $License
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $License)
    {
        //
    }
}
