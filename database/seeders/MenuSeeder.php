<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $menus = [
        [
            "name"=>"Home",
            "route"=>"home",
            "icon"=>"fas fa-fw fa-home",
            "order"=>1,
            "admin"=>0
        ],
        [
            "name"=>"Upload video",
            "route"=>"videos.create",
            "icon"=>"fas fa-fw fa-cloud-upload-alt",
            "order"=>2,
            "admin"=>0
        ],
        [
            "name"=>"Pages",
            "route"=>"#",
            "icon"=>"fas fa-fw fa-folder",
            "order"=>3,
            "admin"=>0
        ],
        [
            "name"=>"Login",
            "route"=>"login.index",
            "order"=>1,
            "admin"=>0,
            "parent_id" => 3
        ],
        [
            "name"=>"Register",
            "route"=>"register.index",
            "order"=>2,
            "admin"=>0,
            "parent_id" => 3
        ],
        [
            "name"=>"Contact",
            "route"=>"contact.index",
            "order"=>3,
            "admin"=>0,
            "parent_id" => 3
        ],
        [
            "name"=>"History",
            "route"=>"history.show",
            "icon"=>"fas fa-fw fa-history",
            "order"=>4,
            "admin"=>0
        ],
        [
            "name"=>"Liked videos",
            "route"=>"liked.show",
            "icon"=>"fa fa-thumbs-up",
            "order"=>5,
            "admin"=>0
        ],

        [
            "name" => "Dashboard",
            "icon" => 'fas fa-tachometer-alt',
            "route" => "admin.dashboard",
            "order" => 1,
            "admin" => 1
        ],
        [
            "name" => "Actions",
            "icon" => 'fas fa-tasks',
            "route" => "admin.actions",
            "order" => 2,
            "admin" => 1
        ],
        [
            "name" => "Users",
            "icon" => 'fa fa-user',
            "route" => "admin.users",
            "order" => 3,
            "admin" => 1
        ],
        [
            "name" => "Videos",
            "icon" => 'fa fa-play-circle',
            "route" => "admin.videos",
            "order" => 4,
            "admin" => 1
        ],
        [
            "name" => "Categories",
            "icon" => 'fa fa-list',
            "route" => "admin.categories",
            "order" => 5,
            "admin" => 1
        ]
    ];

    public function run(): void
    {
        //
        foreach ($this->menus as $menu){
            Menu::create($menu);
        }
    }
}
