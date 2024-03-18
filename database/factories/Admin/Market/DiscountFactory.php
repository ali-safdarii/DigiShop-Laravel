<?php

namespace Database\Factories\Admin\Market;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Market\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isPublic = $this->faker->boolean(50); // 50% chance of being true

        return [
            'discount_code' => $this->faker->unique()->bothify('????##'),
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'discount_type' => $this->faker->randomElement(['Percentage', 'Fixed Amount']),
            'discount_value' => $this->faker->randomFloat(2, 5, 50),
            'minimum_order_amount' => $this->faker->optional()->randomFloat(2, 10, 100),
            'maximum_uses' => $this->faker->optional()->numberBetween(100, 1000),
            'usage_count' => $this->faker->numberBetween(0, 50),
            'is_active' => $this->faker->boolean(90), // 90% chance of being true
            'is_public' => $isPublic,
            'user_id' => $isPublic ? null : $this->faker->numberBetween(1,5), // Replace with your desired special user identifiers
            'description' => $this->faker->text(), // Replace with your desired special user identifiers
        ];

    }
}
