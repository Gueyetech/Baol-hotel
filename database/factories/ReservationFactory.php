<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date_arrivee = $this->faker->dateTimeBetween('+1 week', '+1 month');
        $date_depart = $this->faker->dateTimeInInterval($date_arrivee, '+1 week'); // Assurez-vous que date_depart est au moins une semaine après date_arrivee

        return [
            // 'reference' => 'BH' . $this->faker->unique()->regexify('[A-Za-z0-9]{10}'),
            'reference' => 'BH' . time(),
            'date_arrivee' => $date_arrivee,
            'date_depart' => $date_depart,
            'nombre' => $this->faker->numberBetween(1, 16),
            'status' => $this->faker->randomElement(['paye', 'non paye']),
            'reservable_id' => $this->faker->numberBetween(1, 4),
            'client_id' => $this->faker->numberBetween(1, 4),
        ];
    }
}
