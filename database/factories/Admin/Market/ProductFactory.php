<?php

namespace Database\Factories\Admin\Market;

use App\Models\Admin\Content\PostCategory;
use App\Models\Admin\Market\Product;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Market\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $product_names = [
            'iPhone X2',
            'GalaxyTab Pro',
            'PlayStation 5 Pro',
            'MacBook Air Pro',
            'Xbox Series Z',
            'Google Pixel Ultra',
            'Samsung QLED 8K TV',
            'Sony Alpha A7R IV',
            'Bose QuietComfort 45',
            'Amazon Echo Plus'
        ];

        $faker = $this->faker;
        return [
            'name' => $faker->randomElement($product_names),
            'introduction' => $faker->text,
            'slug' => $faker->unique()->slug,
            'image' => $faker->imageUrl,
            'weight' => $faker->randomFloat(2, 1, 100),
            'length' => $faker->randomFloat(1, 1, 100),
            'width' => $faker->randomFloat(1, 1, 100),
            'height' => $faker->randomFloat(1, 1, 100),
            'price' => $faker->randomFloat(3, 1, 1000),
            'status' => $faker->randomElement([0, 1]),
            'marketable' => $faker->randomElement([0, 1]),
            'sold_number' => $faker->randomElement([0, 1]),
            'frozen_number' => $faker->randomElement([0, 1]),
            'marketable_number' => $faker->randomElement([0, 1]),
            'brand_id' => $faker->numberBetween(1, 5),
            'category_id' => $faker->numberBetween(1, 5), //product_categories,
            'default_color_id' => $faker->numberBetween(1, 5),
            'published_at' => $faker->dateTime,
        ];
    }


    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $tag_ids = Tag::pluck('id')->toArray();
            // $random_tag_ids = \Faker\Factory::create()->randomElements($tag_ids, Faker::create()->numberBetween(1, 10));
            foreach ($tag_ids as $tag_id) {
                $product->tags()->attach($tag_id);
            }
        });
    }
}
