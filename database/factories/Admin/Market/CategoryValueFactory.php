<?php

namespace Database\Factories\Admin\Market;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Market\CategoryValue>
 */
class CategoryValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'product_id' => $this->faker->numberBetween(1,5),
            'category_attribute_id' => $this->faker->numberBetween(1,5),
            'value' => $this->faker->name,
        ];
    }
}
