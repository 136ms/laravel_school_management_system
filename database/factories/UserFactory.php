<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;


class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fname' => $this->faker->firstName,
            'lname' => $this->faker->lastName,
            'birthdate' => $this->faker->date(),
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Other']),
            'phonenum' => $this->faker->phoneNumber(),
            'password' => Hash::make('password'), // password
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'email_verified_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
