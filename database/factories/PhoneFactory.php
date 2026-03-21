<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Phones>
 */
class PhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "phone_band" => $this->faker->randomElement(['BrandA', 'BrandB', 'BrandC']),
            "phone_model" => $this->faker->word(),
            "phone_price" => $this->faker->randomFloat(2, 100, 2000),
            "phone_display_size" => $this->faker->numberBetween(4, 7),
            "phone_is_smartphone" => $this->faker->boolean()
        ];
    }
}
