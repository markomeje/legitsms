<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'status' => 'inactive',
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('1234'),
            'verified' => false,
            'role' => 'user',
        ];
    }
}
