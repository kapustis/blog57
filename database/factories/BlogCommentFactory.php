<?php

namespace Database\Factories;

use App\Models\BlogComment;
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
            'blog_post_id' => rand(1, 50),
            'user_id' => rand(1, 5),
            'content' => $this->faker->realText(rand(200, 500)),
        ];
    }
}
