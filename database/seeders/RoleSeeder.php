<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $roles = ["user","admin"];

    public function run(): void
    {
        //
        foreach ($this->roles as $role){
            Role::create([
               "name"=>$role
            ]);
        }
    }
}
