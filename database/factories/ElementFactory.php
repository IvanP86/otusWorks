<?php

namespace Database\Factories;

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
            'price' => fake()->numberBetween($min = 1500, $max = 10000),
            'article' => fake()->numberBetween($min = 1, $max = 100000),
            'description' => fake()->paragraph(),
            'brand' => fake()->word,
            'volume' => fake()->randomDigit,
            'category_id' => \App\Models\Category::all()->random()->id,
        ];
    }
}
