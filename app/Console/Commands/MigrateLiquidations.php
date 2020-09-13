<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Payment;
use App\Liquidation;
use Illuminate\Support\Facades\Schema;
use Artisan;
use App\Fine;
use App\Concept;
use App\Application;
use App\Affidavit;

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
            $model = Application::withTrashed()->find(
                $liquidation->application_id
            );
            return [$model, $model->concept];
        }
        if ($liquidation->fine_id) {
            $model = Fine::withTrashed()->find(
                $liquidation->fine_id
            );
            return [$model, $model->concept];
        }
        if ($liquidation->affidavit_id) {
            $model = Affidavit::withTrashed()->find(
                $liquidation->affidavit_id
            );
            return [$model, Concept::find(1)];
        }
    }

    public function migrateCanceledLiquidations()
    {
        $fines = Fine::whereHas('getNull')->withTrashed()->get();
        $affidavits = Affidavit::whereHas('getNull')->withTrashed()->get();
        $applications = Application::whereHas('getNull')->withTrashed()->get();

        $models = collect($fines)
            ->merge($affidavits)
            ->merge($applications);

        foreach($models as $model) {
            $liquidation = $model->liquidation;
            if ($liquidation) {
                $liquidation->canceledLiquidation()->create([
                    'reason' => $model->getNull->reason,
                    'user_id' => $model->user_id
                ]);
            }
        }
    }

    public function migrateLiquidations()
    {
        $liquidations = Liquidation::withTrashed()->get();

        foreach($liquidations as $liquidation) {
            $payment = Payment::withTrashed()
                ->whereId($liquidation->payment_id)
                ->whereStatusId(2)
                ->first();

            if (!$liquidation->payment()->exists()) {
                $liquidation->payment()->sync($payment);
            }
            if (!$liquidation->concept()->exists()) {
                $data = $this->getConceptId($liquidation);
                $model = $data[0];
                $concept = $data[1];
                $status = $payment ? 2 : 1;

                $liquidation->update([
                    'model_id' => $model->id,
                    'status_id' => $status,
                    'taxpayer_id' => $payment->taxpayer_id,
                    'concept_id' => $concept->id,
                    'user_id' => $model->user_id
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
        $this->migrateCanceledLiquidations();
    }
}
