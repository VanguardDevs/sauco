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
use App\Traits\ReportUtils;

class PaymentController extends Controller
{
    use ReportUtils;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Payment::orderBy('num', 'ASC')
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
                $query->whereDate('processed_at', '<', $filters['lt_date']);
            }
            if (array_key_exists('rif', $filters)) {
                $name = $filters['rif'];

                $query->whereHas('taxpayer', function ($query) use ($name) {
                    return $query->whereLike('rif', $name);
                });
            }
            if (array_key_exists('payment_type_id', $filters)) {
                $query->where('payment_type_id', '=', $filters['payment_type_id']);
            }
            if (array_key_exists('payment_method_id', $filters)) {
                $query->where('payment_method_id', '=', $filters['payment_method_id']);
            }
        }

        if ($request->type == 'pdf') {
            return $this->report($query);
        }

        return $query->paginate($results);
    }

    public function report($query)
    {
        // Prepare pdf
        $total = ReportUtils::getTotalFormattedAmount($query, 'amount');
        $payments = $query->get();
        $dates = ReportUtils::getDatesFormatted($payments, 'processed_at');
        $title = "Reporte de pagos";

        $pdf = PDF::LoadView('pdf.reports.payments', compact([
            'payments',
            'total',
            'title',
            'dates'
        ]));

        return $pdf->download();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->get('references') as $ref) {
            $payment->references()->create([
                'reference' => $ref,
                'account_id' => 1,
            ]);
        }
        $liquidations = $request->get('liquidations');

        $paymentNum = Payment::getNewNum();
        $processedAt = Carbon::now();

        // Create payment and update liquidations/movmenets
        $payment = Payment::create([
            'user_id' => Auth::user()->id,
            'payment_method_id' => $request->input('method'),
            'status_id' => 2,
            'observations' => $request->input('observations'),
            'num' => $paymentNum,
            'amount' => $request->get('amount'),
            'processed_at' => $processedAt
        ]);
        $payment->liquidations()->sync($liquidations);
        $payment->liquidations()->update([
            'status_id' => 2
        ]);
        $payment->createMovements();

        return response()->json($payment, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Payment $payment)
    {
        $payment = $payment->load([
            'status',
            'taxpayer',
            'paymentType',
            'references',
            'paymentMethod'
        ]);

        if ($request->download) {
            $reference = (!!$payment->reference) ? $payment->reference->reference : 'S/N';
            $taxpayer = $payment->taxpayer;
            $title = 'Factura #'.$payment->num;

            $denomination = (!!$taxpayer->commercialDenomination) ? $taxpayer->commercialDenomination->name : $taxpayer->name;
            $vars = ['payment', 'reference', 'denomination'];

            return PDF::loadView('pdf.bills.invoice', compact([
                'title',
                'payment',
                'reference',
                'denomination',
                'title'
            ]))
                ->stream('factura-'.$payment->id.'.pdf');
        }

        return response()->json($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnullmentRequest $request, Payment $payment)
    {
        $payment->movements()->delete();
        $payment->liquidations()->update(['status_id' => 1]);
        $payment->delete();

        $payment->cancellations()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id,
            'cancellation_type_id' => 4
        ]);

        return response()->json('¡Pago '.$payment->num.' anulado!', 200);
    }
}
