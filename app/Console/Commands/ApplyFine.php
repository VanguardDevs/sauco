<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Taxpayer;
use App\Concept;
use App\Fine;
use App\Settlement;
use App\Payment;
use Carbon\Carbon;

class ApplyFine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apply:fine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apply fines every two weeks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $payments = Payment::whereStateId(1)
            ->whereHas('affidavit');

        if ($payments->count()) {
            $payments->get()->each(function ($payment) {
                // Apply a fine to all payments except those whose
                // Fine was annulled
                if (!$payment->fine()->onlyTrashed()->first()) {
                    $this->checkForFine($payment->affidavit()->first());
                    $payment->updateAmount();
                }
            });
        }
    }
    
    public function applyFine($amount, $concept, $payment)
    {
        if ($concept) {
            $amount = Fine::calculateAmount($amount, $concept);

            $fine = $concept->fines()->create([
                'amount' => $amount,
                'active' => true,
                'taxpayer_id' => $payment->taxpayer_id,
                'user_id' => $payment->user_id,
            ]);

            $settlement = $fine->settlement()->create([
                'num' => Settlement::newNum(),
                'object_payment' => $concept->name,
                'amount' => $amount,
                'payment_id' => $payment->id 
            ]);
        }
    }

    public function checkForFine($affidavit)
    {
        $startPeriod = Carbon::parse($affidavit->month->start_period_at);
        $todayDate = Carbon::now();
        $passedDays = $startPeriod->diffInDays($todayDate);
        $payment = $affidavit->payment()->first();
        $concept = Concept::whereCode(3)->first();
        $amount = $affidavit->settlement->amount;

        if (!$affidavit->hasException()) {
            if ($passedDays > 45 && $payment->settlements()->count() == 1) {
                // Creamos una multa
                $this->applyFine($amount, $concept, $payment);
            }
            if ($passedDays > 60 && $payment->settlements()->count() == 2) {
                // Creamos otra multa
                $this->applyFine($amount, $concept, $payment);
            }
        }
    }
}
