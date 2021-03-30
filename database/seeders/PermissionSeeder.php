<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUser = new Permission();
        $manageUser->name = 'Manage users';
        $manageUser->slug = 'manage-users';
        $manageUser->save();

        $managePost = new Permission();
        $managePost->name = 'Manage posts';
        $managePost->slug = 'manage-posts';
        $managePost->save();

        $createPost = new Permission();
        $createPost->name = 'Create posts';
        $createPost->slug = 'create-posts';
        $createPost->save();


    }
}
