<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Year;
use Carbon\Carbon;

class CreateNewYear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:year';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new year a month';

    /**
     * Array of months
     */
    protected $months = Array(
        'ENERO', 'FEBRERO', 'MARZO', 'ABRIL',
        'MAYO', 'JUNIO', 'JULIO', 'AGOSTO',
        'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
    );

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
        $year = Year::create([
            'year' => Carbon::now()->format('Y')
        ]);

        foreach ($this->months as $key => $value) {
            $year->months()->create([
                'name' => $value
            ]);
        }
    }
}
