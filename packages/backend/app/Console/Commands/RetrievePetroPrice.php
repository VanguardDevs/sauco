<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PetroPrice;
use Illuminate\Support\Facades\Http;

class RetrievePetroPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:petro-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve the latest petro price';

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
        $response = Http::post('https://petroapp-price.petro.gob.ve/price/', [
            "coins" => [
		        "PTR"
            ],
            "fiats" => [
		        "Bs"
	        ]
        ]);

        $data = json_decode($response->getBody(), true);

        if ($data['status'] == 200) {
            $price = $data['data']['PTR']['BS'];

            PetroPrice::create([
                'value' => $price
            ]);
        }
    }
}
