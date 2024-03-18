<?php

namespace Database\Factories\Admin\Market;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Market\CategoryAttribute>
 */
class CategoryAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $units = ['cm','gb','mb','large','sm','xlarge'];
        return [
            'name' => $this->faker->name,
            'unit' => $this->faker->randomElement($units),
            'category_id' => $this->faker->numberBetween(1,5),
        ];
    }
}
