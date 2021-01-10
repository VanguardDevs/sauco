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

    public static function migrateCanceledLiquidations()
    {
        $fines = Fine::onlyTrashed()->whereHas('getNull')->get();
        $affidavits = Affidavit::onlyTrashed()->whereHas('getNull')->get();

        $collection = collect($fines);
        $models = $collection->merge($affidavits);

        foreach($models as $model) {
            $liquidation = $model->liquidation
                ? $model->liquidation
                : $model->makeLiquidation();

            $deletedAt = $model->getAttributes()['deleted_at'];

            $liquidation->update(['deleted_at' => $deletedAt]);

            if ($liquidation) {
                $liquidation->canceledLiquidation()->create([
                    'reason' => $model->getNull->reason,
                    'user_id' => $model->user_id,
                ]);
                $liquidation->canceledLiquidation()->update([
                    'created_at' => $deletedAt
                ]);
            }
        }
    }

    public function migrateLiquidations()
    {
        $liquidations = Liquidation::withTrashed()
            ->whereNull('concept_id')
            ->get();

        foreach($liquidations as $liquidation) {
            $model = Payment::withTrashed()
                ->whereId($liquidation->payment_id);
            $payment = $model->first();

            if ($model->exists() && $payment->status_id == 2) {
                $liquidation->payment()->sync($payment);
                $status = 2;
            } else {
                $status = 1;
            }

            $data = $this->getConceptId($liquidation);
            $model = $data[0];
            $concept = $data[1];

            $liquidation->update([
                'liquidable_type' => get_class($model),
                'liquidable_id' => $model->id,
                'status_id' => $status,
                'taxpayer_id' => $payment->taxpayer_id,
                'concept_id' => $concept->id,
                'user_id' => $model->user_id
            ]);
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
        if (!Schema::hasTable('requirements')) {
            Artisan::call('migrate', [
                '--path' => 'database/migrations/2020_10_05_133535_create_requirements_table.php',
                '--force' => true
            ]);
        }
        if (!Schema::hasTable('intervals')) {
            Artisan::call('migrate', [
                '--path' => 'database/migrations/2020_10_05_161003_create_intervals_table.php',
                '--force' => true
            ]);
        }

        $this->migrateLiquidations();     
        $this->migrateCanceledLiquidations();
    }
}
