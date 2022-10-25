<?php

namespace Database\Factories;

use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventCategory>
 */
class EventCategoryFactory extends Factory
{
    protected $model = EventCategory::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'slug' => $this->faker->slug,
            'body' => $this->faker->paragraph,
        ];
    }
}
