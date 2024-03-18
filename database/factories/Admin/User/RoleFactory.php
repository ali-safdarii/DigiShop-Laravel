<?php

namespace Database\Factories\Admin\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\User\Role>
 */
class RoleFactory extends Factory
{
    protected $model = \App\Models\Admin\User\Role::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            $roles = [
                'admin',
                'user',
                'manager',
                'editor',
                'viewer',
                'moderator',
                'contributor',
                'superuser',
                'guest',
                'subscriber',

            ];
        return [
            'name' => $this->faker->randomElement($roles),
            'description' => $this->faker->text,
            'status' => $this->faker->numberBetween(1,0),
        ];
    }
}
