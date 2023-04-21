<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition(): array
    {
        return [
             //FirstName	LastName	email	password	confirm_password	address	city	role	image	phone	document_validation	status	validation	email_verified_at	
             'FirstName' => $this->faker->firstName,
             'LastName' => $this->faker->lastName,
             'email' => $this->faker->unique()->safeEmail,
             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
             //Confirm password needs to be the same as password
             'confirm_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
             'address' => $this->faker->address,
             'city' => $this->faker->city,
             'role' => $this->faker->randomElement(['apprenant', 'company']),
             'image' => $this->faker->imageUrl(640, 480, 'people'),
             'phone' => $this->faker->phoneNumber,
             'document_validation' => $this->faker->imageUrl(640, 480, 'people'),
             'status' => $this->faker->randomElement(['company', 'apprenant']),
             'validation' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
             'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
