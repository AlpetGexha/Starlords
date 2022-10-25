<?php

namespace Database\Factories;

use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->name,
            'is_verified' => $this->faker->boolean(10),
            'slug' => $this->faker->slug,
            'body' => $this->faker->text,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'category' => [$this->faker->randomElement(EventCategory::all()->pluck('title')->toArray())],
            'facebook' => $this->faker->url,
            'twitter' => $this->faker->url,
            'instagram' => $this->faker->url,
            'linkedin' => $this->faker->url,
            'website' => $this->faker->url,
            'location' => $this->faker->city,
            'address' => $this->faker->address,
            'is_active' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
