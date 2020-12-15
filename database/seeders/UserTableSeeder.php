<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Автор не известен',
                'email' => 'author_unknown@mail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Автор #1',
                'email' => 'author_1@mail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
            ]
        ];
        DB::table('users')->insert($data);
    }

}
