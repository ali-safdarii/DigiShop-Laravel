<?php

namespace Database\Factories\Admin\Market;

use App\Models\Admin\Market\Delivery;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Market\Delivery>
 */
class DeliveryFactory extends Factory
{
    protected $model = Delivery::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();
        return [
            'name' => $faker->name(),
            'amount' => $faker->randomDigit(),
            'description' => $faker->paragraph(),
            'status' => $faker->numberBetween(0, 1),

        ];
    }
}
