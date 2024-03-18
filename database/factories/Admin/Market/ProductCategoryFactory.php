<?php

namespace Database\Factories\Admin\Market;

use App\Models\Admin\Market\ProductCategory;
use App\Models\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Market\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    protected $model = ProductCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;
        $parentIds = [null, null, null, 1, 1, 2, 2, 3, 3, 3];
        $names = ['Electronics', 'Fashion', 'Home and Garden', 'Smartphones', 'Laptops', 'Men\'s Clothing', 'Women\'s Shoes', 'Kitchenware', 'Bedroom Decor', 'Outdoor Living'];
        $descriptions = [
            'Category for electronic devices and accessories',
            'Category for clothing, shoes, and accessories',
            'Category for home decor, furniture, and gardening items',
            'Category for mobile phones with advanced features',
            'Category for portable computers with different sizes',
            'Category for men\'s apparel',
            'Category for women\'s footwear',
            'Category for kitchen tools and appliances',
            'Category for items to decorate the bedroom',
            'Category for outdoor furniture and decor'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($names),
            'description' =>  $this->faker->randomElement($descriptions),
            'parent_id' => $this->faker->randomElement($parentIds),
            // 'image' => $faker->imageUrl,
            'status' => $faker->numberBetween(0, 1),
            'slug' => $faker->slug,
            'show_in_menu' => $faker->numberBetween(0, 1),
        ];
    }


    public function configure()
    {
        return $this->afterCreating(function (ProductCategory $model) {
            $tag_ids = Tag::pluck('id')->toArray();
            // $random_tag_ids = \Faker\Factory::create()->randomElements($tag_ids, Faker::create()->numberBetween(1, 10));
            foreach ($tag_ids as $tag_id) {
                $model->tags()->attach($tag_id);
            }
        });
    }
}
