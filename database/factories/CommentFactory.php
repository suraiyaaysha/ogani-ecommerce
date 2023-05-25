<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $blog = Blog::inRandomOrder()->first();

        return [
            // 'user_id' => function () {
            //     return \App\Models\User::factory()->create()->id;
            // },
            // 'blog_id' => function () {
            //     return \App\Models\Blog::factory()->create()->id;
            // },

            'user_id' => $user->id,
            'blog_id' => $blog->id,

            'parent_id' => null,
            'body' => $this->faker->paragraph,
        ];
    }
}

