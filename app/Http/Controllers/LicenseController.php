<?php

namespace App\Http\Controllers;

use App\CorrelativeType;
use App\License;
use App\Application;
use App\Services\LicenseService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use App\Taxpayer;
use Carbon\Carbon;

class LicenseController extends Controller
{
    protected $license;

    public function __construct(LicenseService $license)
    {
        $this->license = $license; 
        $this->middleware('auth');
        $this->middleware('can:access.licenses')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Taxpayer $taxpayer)
    {
        return view('modules.taxpayers.economic-activity-licenses.index');
    }

    public function list()
    {
        $query = License::with(['taxpayer'])
            ->orderBy('created_at', 'DESC');

        return DataTables::eloquent($query)
            ->addColumn('num', function (License $license) {
                return $license->num;
            })
            ->toJson();
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
    public function create()
    {
        //
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

        $this->license->makeLicense($correlative, $taxpayer);
        
        return redirect('taxpayers/'.$taxpayer->id.'/economic-activity-licenses')
            ->withSuccess('¡Licencia de actividad económica creada!');
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

        if ($correlativeType->description == 'R-') {
            $useConformityPaid = Application::hasPaid($taxpayer, 4);

            if (!$useConformityPaid) {
                $isValid['error'] = true;
                $isValid['msg'] = '¡No ha pagado por una conformidad de uso en el último año!';
            }
        }

        return $isValid;
    }

    public function validateRenovation($taxpayer)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taxpayer $taxpayer
     * @return \Illuminate\Http\Response
     */
    public function show(Taxpayer $taxpayer)
    {
        $correlatives = [
            1 => 'INSTALAR LICENCIA',
            2 => 'RENOVAR LICENCIA'
        ];

        return view('modules.licenses.index')
            ->with('taxpayer', $taxpayer)
            ->with('correlatives', $correlatives);
    }

    public function download(License $license)
    {
        $taxpayer = $license->taxpayer;
        $num = preg_replace("/[^0-9]/", "", $taxpayer->rif);
        $endOfYear = date('d-m-Y', strtotime(Carbon::now()->copy()->endOfYear()));
        $correlative = $license->correlative;
        $licenseCorrelative = $correlative->correlativeType->description.
                             $correlative->year->year.'-'
                             .$correlative->correlativeNumber->num;

        $representation = $taxpayer->president()->first()->person->name;

        $vars = ['license', 'taxpayer', 'num', 'representation', 'licenseCorrelative', 'endOfYear'];

        return PDF::setOptions(['isRemoteEnabled' => true])
            ->loadView('modules.licenses.pdf.economic-activity-license', compact($vars)) 
            ->download('Licencia '.$taxpayer->rif.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\License  $License
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
     * @param  \App\License  $License
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, License $License)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\License  $License
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $License)
    {
        //
    }
}
