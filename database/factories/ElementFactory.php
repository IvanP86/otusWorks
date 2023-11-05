<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Element>
 */
class ElementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'price' => fake()->numberBetween(1500, 10000),
            'article' => fake()->numberBetween(1, 100000),
            'description' => fake()->paragraph(),
            'brand' => fake()->word,
            'volume' => fake()->randomDigit,
            'category_id' => Category::query()->inRandomOrder()->first()->id,
        ];
    }
}
