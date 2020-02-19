<?php

namespace App\Http\Controllers;

use App\EconomicActivitySettlement;
use App\Month;
use App\Concept;
use App\Taxpayer;
use App\BankAccount;
use App\Payment;
use App\PaymentState;
use App\PaymentType;
use App\Reference;
use App\Settlement;
use App\Application;
use App\ApplicationState;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Payments\PaymentsFormRequest;
use Redirect;
use Session;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('has.role:admin')->only('destroy');
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.payments.index');
    }

    public function list()
    {
        // $status = PaymentState::whereDescription('PENDIENTE')->first();
        $query = Payment::with(['paymentState', 'settlements.taxpayer']);
            // ->where('payment_state_id', '!=', $status->id);

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        if ($payment->paymentState->description == 'PAGADA') {
            return redirect('payments');
        }
        return $this->edit($payment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $paymentTypes = PaymentType::exceptNull();
        
        $listingName = $payment->settlements->first()
                        ->concept->listing->name;

        if ($listingName == 'LIQUIDACIONES') {
            return view('modules.payments.register')
                ->with('row', $payment);            
        }

        return view('modules.payments.show')
            ->with('row', $payment)
            ->with('paymentTypes', $paymentTypes)
            ->with('bankAccounts', BankAccount::pluck('bank_name', 'id'))
            ->with('typeForm', 'update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentsFormRequest $request, Payment $payment)
    {
        $paymentState = PaymentState::whereDescription('PAGADA')->first();
        $paymentType = PaymentType::whereId($request->input('payment_type'))->first();

        $payment = Payment::find($payment->id);
        $payment->payment_state_id = $paymentState->id;
        $payment->payment_type_id = $paymentType->id;

        if ($paymentType->description != 'EFECTIVO') {
            $reference = $request->input('reference');
            $bankAccount = $request->input('bank_account');

            if (empty($reference) || empty($bankAccount)) {
                return redirect('payments/'.$payment->id)
                        ->withError('¡Faltan datos!');
            }

            $reference = Reference::create([
                'reference' => $request->input('reference'),
                'bank_account_id' => $request->input('bank_account'),
                'payment_id' => $payment->id
            ]);
        }
        $payment->save();

        return redirect('payments')->withSuccess('¡Liquidación pagada!');
    }

    public function download(Payment $payment)
    {
        if ($payment->paymentState->description != 'PAGADA') {
            return redirect('payments/'.$payment->id)
                ->withError('¡La factura no ha sido pagada!');
        }
    }

    public function checkApplication(Settlement $settlement)
    {
        if (isset($settlement->application)) {
            $application = Application::find($settlement->application->id);
            $application->delete();
        }
    }

    public function settlements(Taxpayer $taxpayer)
    {
        $concept = Concept::find(3); 
        $month = Month::find(Carbon::now()->month - 1);
    
        $payNum = Payment::getNum();
        $type = PaymentType::whereDescription('S/N')->first();
        $paymentState = PaymentState::whereDescription('PENDIENTE')->first();

        // Make payments
        $payment = Payment::create([
            'num' => $payNum,
            'amount' => 0.0,
            'total_amount' => 0.0,
            'payment_state_id' => $paymentState->id,
            'payment_type_id' => $type->id,
        ]);

        foreach ($taxpayer->economicActivities as $activity) {
            $settlementNum = Settlement::getNum();
            
            $settlement = Settlement::create([
                'num' => $settlementNum,
                'amount' => 0.0,
                'concept_id' => $concept->id,
                'payment_id' => $payment->id,
                'month_id' => $month->id,
                'taxpayer_id' => $taxpayer->id
            ]); 

            EconomicActivitySettlement::create([
                'economic_activity_id' => $activity->id,
                'settlement_id' => $settlement->id
            ]); 
        }

        return Response()->json([
            'El liquidador tiene nuevas liquidaciones por pagar'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        if ($payment->paymentState->description == "PAGADA") {
            return response()->json([
                'message' => '¡La factura ya fue pagada!'
            ], 400);
        }

        foreach($payment->settlements as $model) {
            $settlement = Settlement::find($model->id);
            $this->checkApplication($settlement);
            $settlement->delete();
        }
        $payment->delete();

        return Session::flash('success', '¡Factura anulada!');
    }
}
