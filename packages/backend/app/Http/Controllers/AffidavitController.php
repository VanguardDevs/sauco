<?php

namespace App\Http\Controllers;

use App\Models\Taxpayer;
use App\Models\Year;
use App\Models\Month;
use App\Models\Liquidation;
use App\Models\Affidavit;
use App\Models\Payment;
use App\Models\EconomicActivityAffidavit;
use App\Models\Concept;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\Affidavits\AffidavitsCreateFormRequest;
use Auth;
// use App\Services\AffidavitService;

class AffidavitController extends Controller
{
    // /** Initial variables
    //  * @var $liquidation, $concept, $taxpayer, $month, $receivable, $payment
    //  */
    // protected $economicActivityAffidavit;

    // public function __construct(AffidavitService $economicActivityAffidavit)
    // {
    //     $this->economicActivityAffidavit = $economicActivityAffidavit;
    //     $this->middleware('can:null.settlements')->only('destroy');
    // }

    public function index(Request $request)
    {
        $query = Affidavit::orderBy('num', 'ASC')
            ->with(['taxpayer'])
            ->where('amount', '!=', 0);
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('num', $filters)) {
                $query->whereLike('num', $filters['num']);
            }
            if (array_key_exists('total_brute_amount', $filters)) {
                $query->where('total_brute_amount', '=', $filters['total_brute_amount']);
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
                $query->whereDate('createded_at', '>=', $filters['gt_date']);
            }
            if (array_key_exists('lt_date', $filters)) {
                $query->whereDate('createded_at', '<', $filters['lt_date']);
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

    public function show(Request $request, Affidavit $affidavit)
    {
        //
    }

    /**
     * Make a new Affidavit Liquidation
     * @return Illuminate\Response
     */
    public function store()
    {
        $affidavit = Affidavit::create([
            'taxpayer_id' => $this->taxpayer->id,
            'month_id' => $this->month->id,
            'user_id' => auth()->user()->id,
            'amount' => 0.00
        ]);

        $activities = $this->taxpayer->economicActivities;
        $data = Array();

        foreach($activities as $activity) {
            array_push($data, Array(
                'amount' => 0.00,
                'brute_amount' => 0.00,
                'affidavit_id' => $affidavit->id,
                'economic_activity_id' => $activity->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ));
        }

        EconomicActivityAffidavit::insert($data);

        return redirect('affidavits/'.$affidavit->id);
    }

    /**
     * Update affidavit
     * @return Illuminate\Response
     */
    public function update(Request $request, Affidavit $affidavit)
    {
        $isEditGroup = $request->has('edit-group');

        $amounts = $request->input('activity_liquidations');

        if ($isEditGroup) {
            $amount = $amounts[0];
            $totalAmount = $this->economicActivityAffidavit->updateByGroup($affidavit, $amount);
        } else {
            $totalAmount = $this->economicActivityAffidavit->update($affidavit, $amounts);
        }

        $processedAt = Carbon::now();

        $affidavit->update([
            'amount' => $totalAmount,
            'user_id' => auth()->user()->id,
            'processed_at' => $processedAt,
        ]);

        return redirect('affidavits/'.$affidavit->id)
            ->withSuccess('¡Declaración procesada!');
    }

    /**
     * Returns an error message
     * @param $message
     * @return Illuminate\Response
     */
    public function fireError($message)
    {
        return redirect('taxpayers/'.$this->taxpayer->id.'/affidavits')
            ->withError($message);
    }

    public function destroy(Affidavit $affidavit)
    {
        if ($affidavit->liquidation()->exists()) {
            return response()
                ->json('¡La multa tiene una liquidación asociada!', 400);
        }

        $affidavit->cancellations()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id,
            'cancellation_type_id' => 3
        ]);

        $affidavit->delete();
        $affidavit->fines()->delete();

        return response()
            ->json('¡La declaración '.$affidavit->num.' ha sido anulada exitosamente!', 200);
    }
}
