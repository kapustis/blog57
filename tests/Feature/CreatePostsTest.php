<?php

namespace Tests\Feature;

use App\Models\BlogCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatePostsTest extends TestCase
{
    use RefreshDatabase;

    /** публиковать статью*/
    protected function publishPost($overrides = [])
    {

        $post = make('App\Models\BlogPost', $overrides);
        return $this->post(route('blog.admin.categories.store'), $post->toArray());
    }


    function test_guests_may_not_create_posts()
    {
        $this->withExceptionHandling();
        $this->get('/admin/blog/categories/create')->assertRedirect(route('login'));
        $this->post('/admin/blog/categories')->assertRedirect(route('login'));
    }

    /** для темы требуется канал-категория*/
    /*
    function test_a_post_requires_a_category()
    {
        $this->withExceptionHandling()->signInAdmin(); //todo need users_roles factory
        BlogCategory::factory()->count(2)->create();

        $this->publishPost(['blog_category_id' => null])->assertSessionHasErrors('blog_category_id');
        $this->publishPost(['blog_category_id' => 999])->assertSessionHasErrors('blog_category_id');
    }
    */
}
