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
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Str::random(10),
            'is_admin' => fake()->boolean(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'remember_token' => Str::random(10),
        ];
    }
}
