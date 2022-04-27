<?php

namespace App\Http\Controllers;

use App\Models\Dismissal;
use App\Models\Signature;
use App\Traits\ReportUtils;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class DismissalController extends Controller
{
    public function index(Request $request)
    {
        $query = Dismissal::latest();

        // Return responses
        if ($request->wantsJson()) {
            $query->with(['taxpayer']);

            return DataTables::eloquent($query)->toJson();
        }

        return view('modules.dismissals.index');
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

        $dismissal = Dismissal::create([
            'user_id' => Auth::user()->id,
            'taxpayer_id' => $request->input('taxpayer_id'),
            'license_id' => $request->input('license_id'),
            'dismissed_at' => $dismissedAt
        ]);

        $license->delete();
        $license->taxpayer()->delete();

        return response()->json($dismissal, 200);
    }

    public function destroy(Dismissal $dismissal)
    {
        $dismissal->delete();

        return response()->json($dismissal, 201);
    }

    public function download(Dismissal $dismissal)
    {
        $taxpayer = $dismissal->taxpayer;

        $license = $dismissal->license;

        $user = $dismissal->user;

        $signature = Signature::latest()->first();

        $vars = ['dismissal', 'taxpayer', 'license', 'user', 'signature'];

        return PDF::loadView('pdf.reports.dismissals', compact($vars))
                ->stream('cese-'.$dismissal->id.'.pdf');
   }
}
