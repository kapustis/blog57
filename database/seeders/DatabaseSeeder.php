<?php

namespace Database\Seeders;


use App\Models\BlogComment;
use App\Models\BlogPost;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(BlogCategoriesTableSeeder::class);
        BlogPost::factory(50)->create(
            [
                'blog_category_id' => function () {
                    return rand(1, 11);
                },
                'user_id' => function () {
                    return (rand(1, 5) == 5) ? 3 : 4;
                },
            ]
        );
        BlogComment::factory(50)->create(
            [
                'blog_post_id' => function () {
                    return rand(1, 50);
                },
                'user_id' => function () {
                    return (rand(1, 5) == 5) ? 3 : 4;
                },
            ]
        );
    }

}
