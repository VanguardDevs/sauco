<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;
use App\Taxpayer;
use App\License;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class MigrateLicenseMetadata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:licenses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $endOfYear = Carbon::now()->copy()->endOfYear();

        if (!Schema::hasTable('economic_activity_license')) {
            Artisan::call('migrate', [
                '--path' => 'database/migrations/2020_09_07_191819_create_economic_activity_license_table.php',
                '--force' => true
            ]);
        }

        $taxpayers = Taxpayer::whereHas('licenses')->get();

        foreach($taxpayers as $taxpayer) {
            $license = $taxpayer->licenses()->first();
            $activities = $taxpayer->economicActivities;

            $user = $license->audits->sortByDesc('created_at')->first()->user;
            $representation = $taxpayer->president()->first();
            $license->economicActivities()->sync($activities);
            $license->update([
                'expiration_date' => $endOfYear, 
                'representation_id' => $representation->id,
                'user_id' => $user->id
            ]);
        }

        // Check licenses 
        License::whereDoesntHave('user')->get()->each(function ($license) {
            $userId = $license->audits
                ->sortByDesc('created_at')
                ->first()->user->id;

            return $license->update(['user_id' => $userId]);
        });

        License::whereDoesntHave('representation')->get()->each(function ($license) {
            $representation = $license->taxpayer->president()->first()->id;

            return $license->update(['representation_id' => $representation]);
        });

        License::whereDoesntHave('economicActivities')->get()->each(function ($license) {
            $act = $license->taxpayer->economicActivities;

            return $license->economicActivities()->sync($act);
        });

        License::whereNull('expiration_date')->get()->each(function ($license) {
            return $license->update(['expiration_date' => $endOfYear]);
        });
    }
}
