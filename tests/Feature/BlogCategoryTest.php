<?php

namespace Tests\Feature;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class BlogCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_category_consists_of_posts()
    {
        $category = BlogCategory::factory()->create();

        $post = BlogPost::factory()->create(['blog_category_id' => $category->id]);
        $this->assertTrue($category->posts->contains($post));
    }
}
