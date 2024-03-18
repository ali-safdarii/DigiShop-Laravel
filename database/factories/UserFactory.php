<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;
        return [
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt($faker->password),
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'mobile' => $faker->unique()->phoneNumber,
            'national_code' => $faker->unique()->numerify('##########'), // 10 digit random number
            'slug' => $faker->unique()->slug,
            'image' => $faker->imageUrl(200, 200, 'people'), // generate a random profile photo
           /* 'activation' => $faker->numberBetween(0, 1),
            'activation_date' => now(),*/
            'user_type' => $faker->numberBetween(0, 1),
            'status' => $faker->numberBetween(0, 1),
            'current_team_id' => null, // set to null by default
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     */
    public function withPersonalTeam(callable $callback = null): static
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(fn (array $attributes, User $user) => [
                    'name' => $user->name.'\'s Team',
                    'user_id' => $user->id,
                    'personal_team' => true,
                ])
                ->when(is_callable($callback), $callback),
            'ownedTeams'
        );
    }
}
