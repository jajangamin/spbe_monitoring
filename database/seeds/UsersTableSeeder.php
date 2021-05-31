<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => "Administrator",
            'email' => "admin@admin.com",
            'password' => bcrypt('1'),
            'role_id' => "1",
        ]);
    }
}
