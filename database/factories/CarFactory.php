<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        return [
            'first_name'          => $this->faker->firstName(),
            'last_name'           => $this->faker->lastName(),
            'address'             => $this->faker->streetAddress(),
            'city'                => $this->faker->city(),
            'state'               => $this->faker->stateAbbr(),
            'zip'                 => $this->faker->postcode(),
            'phone'               => $this->faker->phoneNumber(),
            'email'               => $this->faker->safeEmail(),
            'vehicle_type'        => $this->faker->randomElement(['car','truck','motorcycle','other']),
            'year'                => $this->faker->numberBetween(1950, 2025),
            'make'                => $this->faker->randomElement(['Ford','Chevy','Toyota','Honda','BMW','Dodge']),
            'model'               => ucfirst($this->faker->word()),
            'color'               => $this->faker->safeColorName(),
            'previously_attended' => $this->faker->boolean(30),
            'tshirt_size'         => $this->faker->randomElement(['S','M','L','XL','2XL','3XL']),
            'home_church'         => $this->faker->company(),
            'checked_in'          => false,
            'tshirt_given'        => false,
            'party_size'          => $this->faker->numberBetween(0,5),
            'is_last_year_winner' => false,
            'is_test'             => false, // override in seeder
            'prize_drawn'         => false,
            'prize_claimed'       => false,
        ];
    }
}
