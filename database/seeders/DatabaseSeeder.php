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
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(BlogCategoriesTableSeeder::class);
        BlogPost::factory(31)->create();
    }

}
