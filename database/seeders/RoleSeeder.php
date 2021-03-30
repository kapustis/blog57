<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'Admin';
        $admin->slug = 'admin';
        $admin->save();

        $superAdmin = new Role();
        $superAdmin->name = 'Super-Admin';
        $superAdmin->slug = 'super-admin';
        $superAdmin->save();

        $user = new Role();
        $user->name = 'User';
        $user->slug = 'user';
        $user->save();
    }
}
