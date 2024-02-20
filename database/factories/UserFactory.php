<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'username' => fake()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Str::random(10),
            'is_admin' => fake()->boolean(),
            'first_name' => fake()->unique()->firstName(),
            'last_name' => fake()->unique()->lastName(),
            'remember_token' => Str::random(10),
        ];
    }
}
