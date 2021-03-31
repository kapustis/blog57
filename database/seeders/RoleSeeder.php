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
        $roles = [
            ['slug' => 'root', 'name' => 'Super-Admin'],
            ['slug' => 'admin', 'name' => 'Admin'],
            ['slug' => 'user', 'name' => 'User'],
        ];

        foreach ($roles as $item) {
            $role = new Role();
            $role->name = $item['name'];
            $role->slug = $item['slug'];
            $role->save();
        }
    }
}
