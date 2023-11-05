<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Element;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderElement>
 */
class ElementOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Category::query()->inRandomOrder()->first()->id,
            'element_id' => Element::query()->inRandomOrder()->first()->id,
            'count' => fake()->numberBetween(1, 10),
            'price' => fake()->numberBetween(1500, 10000)
        ];
    }
}
