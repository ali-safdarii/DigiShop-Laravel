<?php

namespace Database\Factories\Admin\Content;

use App\Models\Admin\Content\PostCategory;
use App\Models\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostCategoryFactory extends Factory
{
    protected $model = PostCategory::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();
        return [
            'name' => $faker->name,
            'description' => $faker->paragraph(),
           // 'image' => $faker->imageUrl,
            'status' => $faker->numberBetween(0,1),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (PostCategory $model) {
            $tag_ids = Tag::pluck('id')->toArray();
            // $random_tag_ids = \Faker\Factory::create()->randomElements($tag_ids, Faker::create()->numberBetween(1, 10));
            foreach ($tag_ids as $tag_id) {
                $model->tags()->attach($tag_id);
            }
        });
    }
}
