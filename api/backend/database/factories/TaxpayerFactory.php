<?php

namespace Database\Factories;

use App\Models\Taxpayer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxpayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Taxpayer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rif' => $this->faker->taxpayerIdentificationNumber(),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'taxpayer_classification_id' => 1,
            'taxpayer_type_id' => 1,
            'municipality_id' => 1,
            'community_id' => 1
        ];
    }
}
