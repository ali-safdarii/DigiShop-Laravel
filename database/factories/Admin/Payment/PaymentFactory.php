<?php

namespace Database\Factories\Admin\Payment;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Payment\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $faker = $this->faker;
        return [
            'user_id' => $faker->randomElement($userIds),
            'payment_amount' => $faker->randomFloat(3, 10, 100),
            'payment_date' => $faker->date(),
            'payment_method' => $faker->randomElement(['Cash', 'Online', 'Offline']),
            'payment_status' => $faker->randomElement(['Pending', 'Completed', 'Cancelled']),
            'description' => $faker->text(),
        ];
    }
}
