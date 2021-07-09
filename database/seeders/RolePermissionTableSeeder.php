<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Role::all() as $role) {
            if ($role->slug == 'root') { // for the super-admin role, all rights
                foreach (Permission::all() as $perm) {
                    $role->permissions()->attach($perm->id);
                }
            }

            if ($role->slug == 'admin') { // for a smaller administrator role
                $slugs = [
                    'manage-categories','create-category','edit-category','delete-category',
                    'manage-posts','create-post', 'edit-post', 'publish-post', 'delete-post',
                    'create-comment', 'edit-comment', 'publish-comment', 'delete-comment'
                ];

                foreach ($slugs as $slug) {
                    $perm = Permission::where('slug', $slug)->first();
                    $role->permissions()->attach($perm->id);
                }
            }

            if ($role->slug == 'user') { // just a little bit for the average user
                $slugs = ['create-post', 'create-comment'];

                foreach ($slugs as $slug) {
                    $perm = Permission::where('slug', $slug)->first();
                    $role->permissions()->attach($perm->id);
                }
            }
        }
    }
}
