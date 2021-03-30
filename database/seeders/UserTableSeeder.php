<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::where('slug','super-admin')->first();
        $admin = Role::where('slug','admin')->first();
        $user = Role::where('slug','user')->first();

        $manageUsers = Permission::where('slug','manage-users')->first();
        $managePosts = Permission::where('slug','manage-posts')->first();
        $createPosts = Permission::where('slug','create-posts')->first();

        $user1 = new User();
        $user1->name ='Super Admin';
        $user1->email = 'super_admin@mail.com';
        $user1->email_verified_at = now();
        $user1->password = bcrypt('12345678');
        $user1->save();
        $user1->roles()->attach($superAdmin);
        $user1->permissions()->attach($manageUsers);
        $user1->permissions()->attach($managePosts);
        $user1->permissions()->attach($createPosts);

        $user2 = new User();
        $user2->name ='Admin';
        $user2->email = 'admin@mail.com';
        $user2->email_verified_at = now();
        $user2->password = bcrypt('12345678');
        $user2->save();
        $user2->roles()->attach($admin);
        $user2->permissions()->attach($managePosts);
        $user2->permissions()->attach($createPosts);

        $user3 = new User();
        $user3->name ='User';
        $user3->email = 'user@mail.com';
        $user3->email_verified_at = now();
        $user3->password = bcrypt('12345678');
        $user3->save();
        $user3->roles()->attach($user);
        $user3->permissions()->attach($createPosts);

        $user4 = new User();
        $user4->name ='User2';
        $user4->email = 'user2@mail.com';
        $user4->email_verified_at = now();
        $user4->password = bcrypt('12345678');
        $user4->save();
        $user4->roles()->attach($user);
        $user4->permissions()->attach($createPosts);

    }

}
