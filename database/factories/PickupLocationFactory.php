<?php

namespace Database\Factories;

use App\Models\PickupLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PickupLocation>
 */
class PickupLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'address' => $this->faker->address, 
    ];
    }
}
