<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $programs = ['cs','it', 'is', 'emc'];

        return [
            'title' => fake()->unique()->text(32),
            'program' => 'bs' . $programs[array_rand($programs)],
            'excerpt' => fake()->paragraph(),
            'file_name' => 'no-file-test-string',
            'date_submitted' => fake()->date(),
        ];
    }
}
