<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'admin.super@mail.org',
                'name' => 'SuperAdmin',
                'role_id' => config('global.roles_reverse.Super Admin'),
                'password' => bcrypt('P@ssw0rd')
            ],
            [
                'email' => 'developerOne@mail.com',
                'name' => 'DeveloperOne',
                'role_id' => config('global.roles_reverse.Developer'),
                'password' => bcrypt('P@ssw0rd')
            ]
        ]);
//        \App\Models\User::factory(10)->create();

    }
}
