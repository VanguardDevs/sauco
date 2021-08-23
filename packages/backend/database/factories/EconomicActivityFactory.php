<?php

namespace Database\Factories;

use App\Models\EconomicActivity;
use Illuminate\Database\Eloquent\Factories\Factory;

class EconomicActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EconomicActivity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->numberBetween(10000,99999),
            'name' => $this->faker->sentence(6),
            'description' => $this->faker->text(300),
            'aliquote' => $this->faker->randomFloat(2, 0, 8),
            'min_tax' => $this->faker->numberBetween(1000, 9999)
        ];
    }
}
