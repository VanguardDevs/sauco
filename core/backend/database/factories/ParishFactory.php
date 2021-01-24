<?php

namespace Database\Factories;

use App\Parish;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParishFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Parish::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name
        ];
    }
}
