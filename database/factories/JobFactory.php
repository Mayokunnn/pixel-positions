<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle,
            'salary' => fake()->randomNumber(6, true),
            'location' => fake()->address(),
            'schedule' => fake()->randomElement(['Full Time', 'Part Time']),
            'featured' => fake()->randomElement([true, false]),
            'url' => fake()->url,
            'employer_id' => Employer::factory(),
        ];
    }
}
