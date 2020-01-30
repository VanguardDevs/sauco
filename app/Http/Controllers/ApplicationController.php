<?php

namespace App\Http\Controllers;

use App\Application;
use App\Ordinance;
use App\Http\Requests\Applications\ApplicationsCreateFormRequest;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.applications.index');
    }

    public function list()
    {
        $query = Application::query()
            ->with('payment')
            ->with('taxpayer')
            ->orderBy('created_at', 'DESC');

        return DataTables::eloquent($query)->toJson();
    }

    public function listTypes()
    {
        $types = Ordinance::whereHas('ordinanceType', function ($query) {
            $query->where('description', '=', 'SOLICITUDES');
        })->get();

        return $types;
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
    public function store(Request $request)
    {
        //
    }

    public function addApplicationTaxpayer(Request $request)
    {
        // $ordinance = Ordinance::where('ordinance_type_id', $request->input('type'));
        // dd($ordinance);

        // $payment = new Payment([
        //     'num' => ,
        //     'total_amount' => ,
        //     'amount' => ,
        //     'payment_state_id' => ,
        //     'taxpayer_id' => ,
        //     'user_id' => ,
        //     'month_id'
        // ]);

        // $application = new Application([
        //     'num' => '',
        //     'object_payment' => $request->input('description'),
        //     'taxpayer_id' => $request->input('taxpayer')
        // ]);
        // $application->save();

        return redirect('taxpayers/'.$request->input('taxpayer'))->withSuccess('¡Solicitud enviada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    public function approve($id)
    {
        $state = ApplicationState::whereDescription('APROBADA')->first();

        $update = Application::find($id);
        $update->answer_date = Carbon::now();
        $update->application_state_id = $state->id;
        $update->save();

        return redirect('applications')->withSuccess('¡Solicitud aprobada!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $application->delete();
    }
}
