<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique($reset = true)->lexify('Store ??? ???');

        return [
            'name'          => $name,
            'user_id'       => User::factory(),
            'slug'          => Str::slug($name),
            'description'   => $this->faker->text(300),
            'logo'         => $this->faker->imageUrl(),
            'cover'         => $this->faker->imageUrl(),
            'status'        => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
