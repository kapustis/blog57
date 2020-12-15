<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition()
    {
        $title = $this->faker->sentence(rand(3, 9), true);
        $body = $this->faker->realText(rand(1000, 4000));
        $isPublished = rand(1, 5) > 1;

        $createdAt = $this->faker->dateTimeBetween('-3 months', '-2 days');

        $data = [
            'category_id' => rand(1, 11),
            'user_id' => (rand(1, 5) == 5) ? 1 : 2,
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->text(rand(40, 140)),
            'content_raw' => $body,
            'content_html' => $body,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? $this->faker->dateTimeBetween('-2 months', '-1 days') : null,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];

        return $data;
    }
}

