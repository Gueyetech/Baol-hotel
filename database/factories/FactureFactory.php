<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facture>
 */
class FactureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'ref' => 'FCT-BH' . time(),
            'montant' => fake()->numberBetween(20000, 50000),
            'status' => fake()->randomElement(['payé', 'non payé']),
            'reservation_id' => fake()->randomElement([1, 2, 3, 4])

        ];
    }
}
