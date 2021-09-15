<?php

namespace Database\Factories;

use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'blog_post_id' => function () {
            return BlogPost::factory()->create()->id;
            },
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'content' => $this->faker->realText(rand(200, 500)),
        ];
    }
}
