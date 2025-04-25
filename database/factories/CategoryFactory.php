<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = implode(' ', $this->faker->words(5));

        return [
            'name'          => $name,
            'slug'          => Str::slug($name),
            'description'   => $this->faker->text(300),
            'image'         => $this->faker->imageUrl(),
            'status'        => $this->faker->randomElement(['active', 'inactive', 'archived']),
        ];
    }
}
