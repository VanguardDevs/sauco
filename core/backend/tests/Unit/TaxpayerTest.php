<?php

namespace Tests\Unit;

use Tests\TestCase;

class TaxpayerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testTaxpayerCreate()
    {
        $response = $this->postJson('/api/taxpayers', [
            'taxpayer_type_id' => 1,
            'name' => 'Jesus',
            'rif' => 'V-27572434-0',
            'address' => 'Avenida libertad 217',
            'email' => 'jesuodz@gmail.com',
            'municipality_id' => 1,
            'community_id' => 1,
            'taxpayer_classification_id' => 1
        ]);

        $response
            ->dump();
    }
}
