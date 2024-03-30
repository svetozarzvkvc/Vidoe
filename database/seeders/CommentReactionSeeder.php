<?php

namespace Database\Seeders;

use App\Models\CommentReaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentReactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $commentReactions = [
        [
            "comment_id"=>1,
            "reaction_id"=>1,
            "user_id"=>3
        ],
        [
            "comment_id"=>2,
            "reaction_id"=>2,
            "user_id"=>4
        ],
        [
            "comment_id"=>4,
            "reaction_id"=>1,
            "user_id"=>3
        ],
        [
            "comment_id"=>3,
            "reaction_id"=>1,
            "user_id"=>2
        ],
        [
            "comment_id"=>6,
            "reaction_id"=>1,
            "user_id"=>3
        ],
        [
            "comment_id"=>2,
            "reaction_id"=>1,
            "user_id"=>1
        ],
        [
            "comment_id"=>8,
            "reaction_id"=>1,
            "user_id"=>2
        ]
    ];

    public function run(): void
    {
        //
        foreach ($this->commentReactions as $commentReaction){
            DB::table('comment_reaction')->insert($commentReaction);
        }
    }
}
