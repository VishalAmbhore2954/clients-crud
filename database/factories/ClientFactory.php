<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = [
            'Pune', 'Mumbai', 'Delhi', 'Bangalore', 'Chennai', 'Hyderabad'
        ];

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->numerify('9#########'), // Indian-style
            'gstin' => $this->generateGSTIN(),
            'city' => $this->faker->randomElement($cities),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }

    private function generateGSTIN(): string
    {
        $faker = $this->faker;

        // GSTIN format (15 chars, simplified realistic version)
        return strtoupper(
            $faker->numerify('##') .                // State code
            $faker->regexify('[A-Z]{5}') .          // PAN part
            $faker->numerify('####') .              // PAN digits
            $faker->regexify('[A-Z]') .             // PAN last char
            $faker->regexify('[1-9A-Z]') .          // Entity code
            'Z' .                                  // Default
            $faker->regexify('[0-9A-Z]')            // Checksum
        );
    }
}
