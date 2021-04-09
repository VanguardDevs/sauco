<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\PaymentType;
use App\Models\Payment;
use App\Models\Fine;
use App\Models\Concept;
use App\Models\Reference;
use App\Models\Liquidation;
use App\Models\Taxpayer;
use App\Models\PaymentNull;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\AnnullmentRequest;
use PDF;
use Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Payment::orderBy('num', 'DESC')
            ->with(['taxpayer'])
            ->whereStatusId(2);
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('num', $filters)) {
                $query->whereLike('num', $filters['num']);
            }
            if (array_key_exists('amount', $filters)) {
                $query->whereLike('amount', $filters['amount']);
            }
            if (array_key_exists('taxpayer', $filters)) {
                $name = $filters['taxpayer'];

                $query->whereHas('taxpayer', function ($query) use ($name) {
                    return $query->whereLike('name', $name);
                });
            }
            if (array_key_exists('gt_date', $filters)) {
                $query->whereDate('processed_at', '>=', $filters['gt_date']);
            }
            if (array_key_exists('lt_date', $filters)) {
                $query->whereDate('processed_at', '<=', $filters['lt_date']);
            }
            if (array_key_exists('rif', $filters)) {
                $name = $filters['rif'];

                $query->whereHas('taxpayer', function ($query) use ($name) {
                    return $query->whereLike('rif', $name);
                });
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
        $payment = $payment->load([
            'status',
            'taxpayer',
            'paymentType',
            'references',
            'paymentMethod'
        ]);

        return response()->json($payment);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        if ($request->input('method') != '3') {
            $reference = $request->input('reference');

            if (empty($reference)){
                return redirect('payments/'.$payment->id)
                        ->withError('¡Faltan datos!');
            }

            $payment->reference()->create([
                'reference' => $reference,
                'account_id' => 1,
            ]);
        }

        $paymentNum = Payment::getNewNum();
        $processedAt = Carbon::now();

        $payment->update([
            'user_id' => Auth::user()->id,
            'payment_method_id' => $request->input('method'),
            'status_id' => 2,
            'observations' => $request->input('observations'),
            'num' => $paymentNum,
            'processed_at' => $processedAt
        ]);

        return redirect()->back()
            ->withSuccess('¡Factura procesada!');
    }

    public function download(Payment $payment)
    {
        if ($payment->status->id == 2) {
            $reference = (!!$payment->reference) ? $payment->reference->reference : 'S/N';
            $taxpayer = $payment->taxpayer;

            $denomination = (!!$taxpayer->commercialDenomination) ? $taxpayer->commercialDenomination->name : $taxpayer->name;
            $vars = ['payment', 'reference', 'denomination'];

            return PDF::setOptions(['isRemoteEnabled' => true])
                ->loadView('pdf.payment', compact($vars))
                ->stream('factura-'.$payment->id.'.pdf');
        }

        return response()->json([
            'message' => '¡La factura no ha sido procesada!'
        ], 400);
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnullmentRequest $request, Payment $payment)
    {
        // Delete settlements and payment
        $payment->liquidations()->delete();

        $payment->canceledPayment()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id
        ]);
        $payment->delete();

        return response()->json($payment);
    }
}
