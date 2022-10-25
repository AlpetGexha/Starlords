<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 3),
            'profile_id' => $this->faker->numberBetween(1, 3),
            'event_id' => $this->faker->numberBetween(1, 3),
            'uuid' => $this->faker->uuid,
            'stripe_id' => $this->faker->uuid,
            'stripe_token' => $this->faker->uuid,
            'price' => $this->faker->numberBetween(1, 300),
            'date_expire' => $this->faker->dateTimeBetween('now', '+1 year'),
            'refund_date_expire' => $this->faker->dateTimeBetween('now', '+1 year'),
            'status' => $this->faker->randomElement(['paid', 'refunded', 'canceled']),
            'quantity' => $this->faker->numberBetween(1, 10),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
