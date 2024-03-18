<?php

namespace Database\Factories\Admin\Content;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Content\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();
        return [
            'title' => $faker->title(),
            'image' => $faker->imageUrl(),
           // 'description' => $faker->words,
            'position' => $faker->numberBetween(1, 9),
            'status' => $faker->numberBetween(0, 1),
            //'is_used_mobile' => $faker->numberBetween(0, 1),
            'url' => $faker->url
        ];
    }
}
