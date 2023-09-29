<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
        $userIds = User::pluck('id')->all();
        return [
            'title' => fake()->text(50),
            'description' => fake()->text(1000),
            'user_id' => fake()->randomElement($userIds),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Post $post) {
            $tagsIds = Tag::pluck('id')->all();
            $post->tags()->sync(fake()->randomElements($tagsIds, 3));
        });
    }
    /**
     * Indicate that the model's email address should be unverified.
     */

}
