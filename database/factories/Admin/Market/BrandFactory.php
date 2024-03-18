<?php

namespace Database\Factories\Admin\Market;


use App\Models\Admin\Market\Brand;
use App\Models\Model;
use App\Models\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        $faker = Faker::create();
        $names = ['Apple','Samsung','Lg','Asus','HP'];

        return [
            'persian_name' => $faker->word(),
            'name' => $faker->randomElement($names),
            'description' => $faker->paragraph(),
            'slug' => $faker->slug(),
            'status' => $faker->numberBetween(0, 1),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Brand $model) {
            $tag_ids = Tag::pluck('id')->toArray();
            // $random_tag_ids = \Faker\Factory::create()->randomElements($tag_ids, Faker::create()->numberBetween(1, 10));
            foreach ($tag_ids as $tag_id) {
                $model->tags()->attach($tag_id);
            }
        });
    }
}
