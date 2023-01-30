<?php

namespace App\Http\Controllers;

use App\Models\CapacityStamp;
use App\Models\License;
use App\Models\Taxpayer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\CapacityStampFormRequest;
use Illuminate\Database\Eloquent\Builder;


class CapacityStampController extends Controller
{
    
    public function index(Taxpayer $taxpayer, Request $request)
    {

        if ($request->wantsJson()) {

            $query = CapacityStamp::query()
            ->join('licenses', 'licenses.id', '=', 'capacity_stamps.license_id')
            ->join('taxpayers', 'taxpayers.id', '=', 'licenses.taxpayer_id')
            ->where('taxpayers.id', $taxpayer->id)
            ->where('licenses.active', 'true')
            ->select('capacity_stamps.*')
            ->with('license')
            ->orderBy('id', 'desc');

            return DataTables::eloquent($query)->toJson();
        }


        $stamps = CapacityStamp::query()
        ->join('licenses', 'licenses.id', '=', 'capacity_stamps.license_id')
        ->join('taxpayers', 'taxpayers.id', '=', 'licenses.taxpayer_id')
        ->where('taxpayers.id', $taxpayer->id)
        ->where('licenses.active', 'true')
        ->select('capacity_stamps.license_id')
        ->get();

        $existingLicenses = DB::table('licenses')
            ->where('taxpayer_id', $taxpayer->id)
            ->where('ordinance_id', 6)
            ->where('expiration_date', '>', Carbon::now())
            ->where('active', 'true')

            ->where(function($query) use ($stamps) {
                foreach($stamps as $stamp){
                    $query->where('id', '<>', $stamp->license_id);
                }
            })
            
            ->groupBy('num', 'id')
            ->having('num', '>', 1)
            ->pluck('num', 'id')
            ->toArray();


        return view('modules.taxpayers.capacity-stamp.index')
            ->with('taxpayer', $taxpayer)
            ->with('existingLicenses', $existingLicenses);
    }



    public function store(CapacityStampFormRequest $request, Taxpayer $taxpayer)
    {
        $license = License::find($request->input('license'));

        $capacityStamp = CapacityStamp::create([
            'capacity' => $request->capacity,
            'license_id' => $license->id,
            'user_id' => Auth::user()->id
            
        ]);

        return redirect()->route('capacity-stamps.index', $taxpayer)
                ->withSuccess('¡Comprobante de Pago de Timbre de Capacidad Agregado!');
    }
}
