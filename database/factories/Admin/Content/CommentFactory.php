<?php

namespace Database\Factories\Admin\Content;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Content\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $commentable_types = [
            'App\Models\Admin\Content\Post',
            'App\Models\Admin\Market\Product'
        ];

        return [
            'body' =>$this->faker->realText(50),
            'parent_id' => $this->faker->numberBetween(1,5) ,
            'user_id' => $this->faker->numberBetween(1,5) ,
            'commentable_id' => $this->faker->numberBetween(1,5) ,
          //  'seen' => $this->faker->randomElement([0, 1]),
            'approved' => $this->faker->randomElement([0, 1]),
            'commentable_type' => $this->faker->randomElement($commentable_types)

        ];
    }
}
