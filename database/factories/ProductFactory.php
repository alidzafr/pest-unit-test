<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            'name' => fake()->text(20),
            'price' => rand(100, 999),
            'quantity' => rand(30, 100),
            'min_threshold' => rand(10, 30),
            'expiry_date' => fake()->date(),
            'availability' => fake()->randomElement(['In-stock', 'Out of stock'])
        ];
    }
}
