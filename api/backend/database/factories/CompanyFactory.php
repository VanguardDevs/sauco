<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'capital' => 1000,
            'num_workers' => 1,
            'constitution_date' => $this->faker->date(),
            'case_file' => 1,
            'num' => 1,
            'volume' => '32 p'
        ];
    }
}
