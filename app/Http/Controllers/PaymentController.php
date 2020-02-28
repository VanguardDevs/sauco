<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use App\PaymentType;
use App\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Payments\PaymentsFormRequest;
use PDF;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('has.role:admin')->only('destroy');
        $this->middleware('has.role:liquidator|collector|admin')->only(['index', 'list']);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.cashbox.list-payments');
    }

    public function list()
    {
        $query = Payment::with(['state'])
            ->orderBy('created_at', 'DESC');

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
        return view('modules.cashbox.register-payment')
            ->with('row', $payment)
            ->with('types', PaymentType::exceptNull())
            ->with('methods', PaymentMethod::exceptNull())
            ->with('typeForm', 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $payment = Payment::find($payment->id);
        $payment->state_id = 2;
        $payment->payment_type_id = $request->input('type');
        $payment->payment_method_id = $request->input('method');

        if ($request->input('method') != '3') {
            $reference = $request->input('reference');

            if (empty($reference)){
                return redirect('payments/'.$payment->id)
                        ->withError('¡Faltan datos!');
            }

            $reference = Reference::create([
                'reference' => $request->input('reference'),
                'account_id' => 1,
                'payment_id' => $payment->id
            ]);
        }
        $payment->save();

        return redirect('cashbox/payments')
            ->withSuccess('¡Liquidación pagada!');
    }

    public function download(Payment $payment)
    {
        $billNum = str_pad($payment->id, 8, '0', STR_PAD_LEFT);
        $reference = (!!$payment->reference) ? $payment->reference->reference : 'S/N';
        $pdf = PDF::LoadView('modules.cashbox.pdf.payment', compact(['payment', 'billNum', 'reference']));
        return $pdf->stream('Licencia '.$payment->id.'.pdf');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
