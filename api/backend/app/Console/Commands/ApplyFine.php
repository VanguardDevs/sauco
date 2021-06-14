<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment;

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
        $payments = Payment::whereStatusId(1)
            ->whereHas('liquidations', function ($q) {
                return $q->whereLiquidableType('App\Models\Affidavit');
            });

        if ($payments->count()) {
            $payments->get()->each(function ($payment) {
                $payment->checkForFine();
            });
        }
    }
}
