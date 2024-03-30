<?php

namespace Database\Seeders;

use App\Models\VideoReaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoReactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $videoReactions = [
        [
            "video_id"=>1,
            "reaction_id"=>1,
            "user_id"=>2
        ],
        [
            "video_id"=>1,
            "reaction_id"=>1,
            "user_id"=>3
        ],
        [
            "video_id"=>13,
            "reaction_id"=>2,
            "user_id"=>1
        ],
        [
            "video_id"=>15,
            "reaction_id"=>1,
            "user_id"=>3
        ],
        [
            "video_id"=>16,
            "reaction_id"=>1,
            "user_id"=>4
        ],
        [
            "video_id"=>7,
            "reaction_id"=>1,
            "user_id"=>2
        ],
        [
            "video_id"=>9,
            "reaction_id"=>1,
            "user_id"=>3
        ],
        [
            "video_id"=>5,
            "reaction_id"=>2,
            "user_id"=>4
        ]

    ];

    public function run(): void
    {
        //
        foreach ($this->videoReactions as $reaction){
            DB::table('video_reaction')->insert($reaction);
        }
    }
}
