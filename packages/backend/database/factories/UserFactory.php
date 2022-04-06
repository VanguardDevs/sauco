<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'identity_card' => $this->faker->unique()->nationalId,
            'names' => $this->faker->name,
            'surnames' => $this->faker->lastName,
            'password' => bcrypt('qwerty123'),
            'login' => $this->faker->username,
            'remember_token' => Str::random(10),
        ];
    }
}
