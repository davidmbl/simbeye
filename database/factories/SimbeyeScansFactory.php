<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SimbeyeScans>
 */
class SimbeyeScansFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = fake()->dateTimeBetween('-30 week', 'now');
        return [
            'rfid_id'=>rand(35,39),
            'amount'=>250,
            'created_at'=> $date,
            'updated_at'=> $date,
        ];
    }
}
