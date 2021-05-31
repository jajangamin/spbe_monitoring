<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert(
            [
                1 => [
                    'name' => "Administrator",
                    'description' => "*** ADMIN ROLE ***",
                    'status' => "1",
                ],
                2 => [
                    'name' => "User",
                    'description' => "User",
                    'status' => "1",
                ]
            ]
        );
    }
}
