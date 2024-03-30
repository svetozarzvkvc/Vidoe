<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $comments = [
      [
          "text"=>"I really like elephants. Nice video.",
          "video_id"=>1,
          "user_id"=>4
      ],
      [
          "text"=>"Haha. Very funny video.",
          "video_id"=>6,
          "user_id"=>4
      ],
      [
          "text"=>"He's got a point.",
          "video_id"=>12,
          "user_id"=>4
      ],
      [
          "text"=>"Yeah he does.",
          "video_id"=>12,
          "user_id"=>3,
          "parent_id"=>3
      ],
      [
          "text"=>"I love this video!",
          "video_id"=>9,
          "user_id"=>4
      ],
      [
          "text"=>"Joe is my favorite joker.",
          "video_id"=>11,
          "user_id"=>2
      ],
      [
          "text"=>"I like Sal more.",
          "video_id"=>11,
          "user_id"=>3,
          "parent_id"=>6
      ],
      [
          "text"=>"Best GTA game ever.",
          "video_id"=>19,
          "user_id"=>4
      ],
      [
          "text"=>"How did he do that?",
          "video_id"=>13,
          "user_id"=>4
      ]
    ];

    public function run(): void
    {
        //
        foreach ($this->comments as $comment){
            Comment::create($comment);
        }
    }
}
