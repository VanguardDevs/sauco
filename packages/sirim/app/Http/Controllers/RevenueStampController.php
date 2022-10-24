<?php

namespace App\Http\Controllers;

use App\Models\RevenueStamp;
use App\Models\License;
use App\Models\Taxpayer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\RevenueStampFormRequest;
use Illuminate\Database\Eloquent\Builder;

class RevenueStampController extends Controller
{
    

    public function index(Taxpayer $taxpayer, Request $request)
    {

        if ($request->wantsJson()) {

            $query = RevenueStamp::query()
            ->join('licenses', 'licenses.id', '=', 'revenue_stamps.license_id')
            ->join('taxpayers', 'taxpayers.id', '=', 'licenses.taxpayer_id')
            ->where('taxpayers.id', $taxpayer->id)
            ->where('licenses.active', 'true')
            ->select('revenue_stamps.*')
            ->orderBy('id', 'desc');

            return DataTables::eloquent($query)->toJson();
        }

        $existingLicenses = DB::table('licenses')
            ->where('taxpayer_id', $taxpayer->id)
            ->where('ordinance_id', 6)
            ->where('expiration_date', '>', Carbon::now())
            ->where('active', 'true')
            ->groupBy('num', 'id')
            ->having('num', '>', 1)
            ->pluck('num', 'id')
            ->toArray();


        return view('modules.taxpayers.revenue-stamp.index')
            ->with('taxpayer', $taxpayer)
            ->with('existingLicenses', $existingLicenses);
    }



    public function store(RevenueStampFormRequest $request, Taxpayer $taxpayer)
    {
        $license = License::find($request->input('license'));

        $revenueStamp = RevenueStamp::create([
            'date' => $request->date,
            'payment_num' => $request->payment_num,
            'amount' => $request->amount,
            'observations' => $request->observations,
            'license_id' => $license->id,
            'user_id' => Auth::user()->id
            
        ]);

        return redirect()->route('revenue-stamps.index', $taxpayer)
                ->withSuccess('¡Comprobante de Pago de Timbre Fiscal Agregado!');
    }
}
