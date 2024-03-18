<?php

namespace Database\Factories\Admin\Content;

use App\Models\Admin\Content\Post;
use App\Models\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class PostFactory extends Factory
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
            'title' => $faker->sentence,
            'body' => $faker->paragraph,
            'slug' => $faker->unique()->slug,
            'status' => $faker->randomElement([0, 1]),
            'summery' => $faker->sentence,
            'image' => $faker->imageUrl(),
            'is_comment' => $faker->randomElement([0, 1]),
           // 'tags' => $faker->words(3, true),
            'published_at' => $faker->dateTimeBetween('-1 year', 'now'),
            'user_id' => $faker->numberBetween(1,5),
            'category_id' => $faker->numberBetween(1,5),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $model) {
            $tag_ids = Tag::pluck('id')->toArray();
            // $random_tag_ids = \Faker\Factory::create()->randomElements($tag_ids, Faker::create()->numberBetween(1, 10));
            foreach ($tag_ids as $tag_id) {
                $model->tags()->attach($tag_id);
            }
        });
    }
}
