<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Payment;
use App\Liquidation;
use Illuminate\Support\Facades\Schema;
use Artisan;
use NullAffidavit;
use NullApplication;
use NullFine;
use NullWithholding;

class MigrateLiquidations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:liquidations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate all liquidations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getConceptId($liquidation)
    {
        if ($liquidation->application_id) {
            return $liquidation->application()->withTrashed()->first()->concept->id;
        }
        if ($liquidation->fine_id) {
            return $liquidation->fine()->withTrashed()->first()->concept->id;
        }
        if ($liquidation->affidavit_id) {
            return 1;
        }
    }

    public function migrateLiquidations()
    {
        $liquidations = Liquidation::withTrashed()->get();

        foreach($liquidations as $liquidation) {
            $payment = Payment::withTrashed()->whereId($liquidation->payment_id)->first();

            if (!$liquidation->payment()->exists()) {
                $liquidation->payment()->sync($payment);
            }
            if (!$liquidation->concept()->exists()) {
                $liquidation->update([
                    'status_id' => $payment->state_id,
                    'taxpayer_id' => $payment->taxpayer_id,
                    'concept_id' => $this->getConceptId($liquidation)
                ]);
            }

            if (!$payment->deleted_at) {
                $liquidation->update([
                    'deleted_at' => $payment->deleted_at
                ]);
            }
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!Schema::hasTable('liquidations')) {
            Artisan::call('migrate', [
                '--path' => 'database/migrations/2020_09_07_220509_create_canceled_liquidations_table.php',
                '--force' => true
            ]);
        }
        $this->migrateLiquidations();     
        $this->migrateLiquidations();     
    }
}
