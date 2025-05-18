<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'         => $this->faker->name(),
            'email'        => $this->faker->email(),
            'username'     => $this->faker->userName(),
            'password'     => Hash::make("secret"),
            'is_super'     => $this->faker->boolean(),
            'status'       => $this->faker->randomElement(['active', 'unactive']),
        ];
    }
}
