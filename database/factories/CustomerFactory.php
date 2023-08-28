<?php

namespace Database\Factories;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'phone_number' => $this->faker->e164PhoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'desired_budget' => $this->faker->numberBetween(1000, 10000),
            'message' => $this->faker->text(300),
        ];
    }
}
