<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Simbeye2>
 */
class SimbeyeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'username' => fake()->name(),
            'card_no' => rand(1111,9999),
            'amount' => rand(500,10000),
            'usage' => rand(0,50),
            'last_used' => fake()->dateTime(),
        ];
    }
}
