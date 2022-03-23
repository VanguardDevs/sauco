<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\License;

class ExpireLicense extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:licenses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire licenses at expiration date';

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
        $currDate = Carbon::now();

        $licenses = License::where('expiration_date', '<=', $currDate);

        // Deactivate
        $licenses->update(['active' => false]);
    }
}
