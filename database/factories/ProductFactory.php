<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'title'              => $name,
            'store_id'          => Store::factory(),
            'category_id'       => Category::factory(),
            'slug'              => Str::slug($name),
            'small_description' => $this->faker->text(100),
            'description'       => $this->faker->text(300),
            'meta_title'        => $this->faker->sentence(6),
            'meta_links'        => implode(', ', $this->faker->words(10)),
            'meta_description'  => $this->faker->text(160),
            'price'             => $this->faker->randomFloat(2, 20, 9999),
            'compare_price'     => $this->faker->randomFloat(2, 20, 9999),
            'rating'            => $this->faker->randomFloat(1, 0, 5),
            'featured'          => $this->faker->boolean(),
            'status'            => $this->faker->randomElement(['active', 'inactive', 'draft', 'archived']),
            'image'             => $this->faker->imageUrl(),
        ];
    }
}
