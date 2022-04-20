<?php

namespace App\Http\Controllers;

use App\Models\Dismissal;
use App\Models\Signature;
use App\Traits\ReportUtils;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class DismissalController extends Controller
{
    public function index(Request $request)
    {
        $query = Dismissal::query();
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('dismissed_at', $filters)) {
                $query->whereLike('dismissed_at', $filters['dismissed_at']);
            }
        }

        return $query->paginate($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dismissedAt = Carbon::now();
        //$dismissal = Dismissal::create($request->all());


        $dismissal = Dismissal::create([
            'user_id' => $request->input('user_id'),
            'taxpayer_id' => $request->input('taxpayer_id'),
            'license_id' => $request->input('license_id'),
            'dismissed_at' => $dismissedAt
        ]);

        return response()->json($dismissal, 200);

    }



    public function destroy(Dismissal $dismissal)
    {
        $dismissal->delete();

        return response()->json($dismissal, 201);
    }



    public function download(Dismissal $dismissal)
    {
        // if ($payment->status->id == 1) {
        //     return redirect()->back()
        //         ->withError('¡La factura no ha sido procesada!');
        // }

        // $reference = (!!$payment->reference) ? $payment->reference->reference : 'S/N';

        $taxpayer = $dismissal->taxpayer;

        $license = $dismissal->license;

        $user = $dismissal->user;

        $signature = Signature::latest()->first();

        $vars = ['dismissal', 'taxpayer', 'license', 'user', 'signature'];

        // return PDF::setOptions(['isRemoteEnabled' => true])
        //         ->loadView('pdf.reports.dismissals', compact($vars))
        //         ->stream('cese-'.$dismissal->id.'.pdf');


        return PDF::loadView('pdf.reports.dismissals', compact($vars))
                ->stream('cese-'.$dismissal->id.'.pdf');
   }
}