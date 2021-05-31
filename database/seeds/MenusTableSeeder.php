<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('menus')->insert(
            [
                1 => [
                    'parent' => "0",
                    'order' => "1",
                    'label' => "Home",
                    'route' => "backend.home",
                    'url' => "backend/home",
                    'mobilepage' => "backend/home",
                    'icon' => "fa fa-dashcube",
                    'description' => "Home Page",
                    'status' => "1",
                ],
                2 => [
                    'parent' => "0",
                    'order' => "999",
                    'label' => "Setting",
                    'route' => "#",
                    'url' => "#",
                    'mobilepage' => "#",
                    'icon' => "fa fa-cogs",
                    'description' => "Setting",
                    'status' => "1",
                ],
                3 => [
                    'parent' => "0",
                    'order' => "1",
                    'label' => "User",
                    'route' => "backend.user.index",
                    'url' => "backend/user/index",
                    'mobilepage' => "backend/user/index",
                    'icon' => "fa fa-group",
                    'description' => "User Page",
                    'status' => "1",
                ],
                4 => [
                    'parent' => "0",
                    'order' => "2",
                    'label' => "Role",
                    'route' => "backend.role.index",
                    'url' => "backend/role/index",
                    'mobilepage' => "backend/role/index",
                    'icon' => "fa fa-hand-rock-o",
                    'description' => "Role Page",
                    'status' => "1",
                ],
                5 => [
                    'parent' => "0",
                    'order' => "3",
                    'label' => "Menu",
                    'route' => "backend.menu.index",
                    'url' => "backend/menu/index",
                    'mobilepage' => "backend/menu/index",
                    'icon' => "fa fa-bars",
                    'description' => "Menu Page",
                    'status' => "1",
                ],
                6 => [
                    'parent' => "0",
                    'order' => "4",
                    'label' => "Access Control",
                    'route' => "backend.accesscontrol.index",
                    'url' => "backend/accesscontrol/index",
                    'mobilepage' => "backend/accesscontrol/index",
                    'icon' => "fa fa-list-alt",
                    'description' => "Access Control Page",
                    'status' => "1",
                ]
            ]
        );
    }
}
