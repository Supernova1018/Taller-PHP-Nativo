<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "venue_name" => $this->faker->company(),
            "venue_address" => $this->faker->address(),
            "venue_max_capacity" => $this->faker->numberBetween(50, 1000)
        ];
    }
}
