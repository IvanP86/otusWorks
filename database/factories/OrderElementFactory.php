<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderElement>
 */
class OrderElementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => \App\Models\Category::all()->random()->id,
            'element_id' => \App\Models\Element::all()->random()->id,
            'price_element' => fake()->numberBetween($min = 1500, $max = 10000),
        ];
    }
}
