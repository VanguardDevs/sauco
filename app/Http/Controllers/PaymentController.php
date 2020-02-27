<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Payments\PaymentsFormRequest;

class PaymentController extends Controller
{
    protected $settlementService;

    public function __construct(SettlementService $settlementService)
    {
        $this->middleware('has.role:admin')->only('destroy');
        $this->middleware('has.role:liquidator|collector|admin')->only(['index', 'list']);
        $this->settlementService = $settlementService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.cashbox.payments');
    }

    public function list()
    {
        $query = Payment::with(['paymentState', 'settlements'])
            ->query();

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
        // First let me know what are the permissions given for
        // This user's role
        dd(Auth()->user()->roles()->permissions);
        if (Auth()->user()->can('update-settlements')) {
            return view('modules.payments.update-payment');
        } else if (Auth()->user()->can('process-payments')) {
            return view('modules.payments.process-payment');
        } else {
            return view('modules.payments.show');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
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

        return redirect('payments')
            ->withSuccess('¡Liquidación pagada!');
    }

    public function download(Payment $payment)
    {
        if ($payment->paymentState->description != 'PAGADA') {
            return response()->json([
                '¡La factura no ha sido pagada!', 400
            ]);
        }
    }

    public function checkApplication(Settlement $settlement)
    {
        if (isset($settlement->application)) {
            $application = Application::find($settlement->application->id);
            $application->delete();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        foreach($payment->settlements as $model) {
            $settlement = Settlement::find($model->id);
            $this->checkApplication($settlement);
            $settlement->delete();
        }
        $payment->delete();

        return Session::flash('success', '¡Factura anulada!');
    }
}
