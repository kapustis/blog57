<?php

namespace Database\Seeders;

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
        $this->call(BlogCategoriesTableSeeder::class);
        BlogPost::factory(1000)->create();
        // \App\Models\User::factory(10)->create();
    }

}
