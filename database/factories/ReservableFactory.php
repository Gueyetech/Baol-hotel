<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservable>
 */
class ReservableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero' => fake()->word(),
            'etage' => fake()->randomFloat(1, 4),
            'capacite' => fake()->numberBetween(1, 5),
            'tarif' => fake()->randomFloat(50000, 100000),
            'description' => fake()->word(),
            'image' => fake()->imageUrl(),
            'etat_id' => $this->faker->randomElement([1, 2, 3]),
            'categorie_id' => $this->faker->randomElement([1, 2, 3, 4]),


        ];
    }
}
