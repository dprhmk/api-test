<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->sentence(4),
            'category_id' => ProductCategory::query()->inRandomOrder()->first(),
            'price' => rand(1000, 100000),
            'description' => $this->faker->text(500),
            'image' => env('APP_URL').'/storage/images/default.jpg',
        ];
    }
}
