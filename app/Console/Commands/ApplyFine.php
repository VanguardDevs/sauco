<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Taxpayer;

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
        $taxpayer = Taxpayer::find(1);

        $fine = $taxpayer->fines()->create([
            'amount' => 10000.00,
            'concept_id' => 1,
            'user_id' => 1,
            'active' => true
        ]);

        $this->info($fine);
    }
}
