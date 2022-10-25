<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'slug' => $this->faker->slug,
            'user_id' => 1,
            'views' => $this->faker->numberBetween(30, 2000),
        ];
    }
}
