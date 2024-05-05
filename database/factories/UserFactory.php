<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();
        // Generate a fake address
        $streetAddress = $faker->streetAddress;
        $city = $faker->city;
        $state = $faker->state;
        $zipCode = $faker->postcode;
        $country = $faker->country;

        // Combine parts into a full address
        $fullAddress = "$streetAddress, $city, $state $zipCode, $country";
        $mobileNumber = '01' . $faker->numberBetween(1, 9) . $faker->randomNumber(8);
        $lastName = $faker->lastName;
        $birthDate = $faker->date($format = 'Y-m-d', $max = 'now');
        return [
            'first_name' => fake()->name(),
            'last_name' => $lastName,
            'address' => $fullAddress,
            'phone' => $mobileNumber,
            'email' => fake()->unique()->safeEmail(),
            'birth_date' => $birthDate,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
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
