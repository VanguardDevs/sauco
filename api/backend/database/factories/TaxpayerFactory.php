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
            'rif' => $this->faker->taxpayerIdentificationNumber,
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email
        ];
    }
}
