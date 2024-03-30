<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash as Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        //
        $userPassword = Hash::make("user");
        $adminPassword = Hash::make("admin");
        $currentDateTime = Carbon::now();

        $users = [
            [
                "username" => "jawed",
                "email" => "jawed@test.com",
                "avatar" => "1709164000.jpeg",
                "password" => $userPassword,
                "role_id" => 1,
                "country_id" => 77,
                'email_verified_at'=>$currentDateTime
            ],
            [
                "username" => "KinetiK001",
                "email" => "kinetiK001@test.com",
                "avatar" => "1709165258.jpeg",
                "password" => $userPassword,
                "role_id" => 1,
                "country_id" => 108,
                'email_verified_at'=>$currentDateTime
            ],
            [
                "username" => "johnspacey",
                "email" => "johnsp@test.com",
                "avatar" => "1709219218.jpeg",
                "password" => $userPassword,
                "role_id" => 1,
                "country_id" => 54,
                'email_verified_at'=>$currentDateTime
            ],
            [
                "username" => "michaelrohn",
                "email" => "michaelr@test.com",
                "avatar" => "1709165477.jpeg",
                "password" => $userPassword,
                "role_id" => 1,
                "country_id" => 99,
                'email_verified_at'=>$currentDateTime
            ],
            [
                "username" => "emasth",
                "email" => "emasmth@test.com",
                "avatar" => "1709165626.jpeg",
                "password" => $adminPassword,
                "role_id" => 2,
                "country_id" => 65,
                'email_verified_at'=>$currentDateTime
            ],
            [
                "username" => "liamrodri",
                "email" => "liamrodri@test.com",
                "avatar" => "1709165639.jpeg",
                "password" => $adminPassword,
                "role_id" => 2,
                "country_id" => 9,
                'email_verified_at'=>$currentDateTime
            ]
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}
