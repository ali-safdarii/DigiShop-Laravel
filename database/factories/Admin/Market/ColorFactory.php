<?php

namespace Database\Factories\Admin\Market;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Market\Color>
 */
class ColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker = $this->faker;
        $colors = ['Red','Green','White','Black'];
        return [
            'name' => $faker->colorName,
            'color_code' => $faker->hexColor,
            'price_increase' => $faker->randomFloat(3, 0, 999999.999),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
        ];
    }


}
