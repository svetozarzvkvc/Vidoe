<?php

namespace Database\Seeders;

use App\Models\Reaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $reactions = ["like","dislike"];
    private $icons = ["fas fa-thumbs-up","fas fa-thumbs-down"];

    public function run(): void
    {
        //

        for ($i=0;$i<count($this->reactions);$i++){
            Reaction::create([
                "name"=>$this->reactions[$i],
                "icon"=> $this->icons[$i]
            ]);
        }
    }
}
