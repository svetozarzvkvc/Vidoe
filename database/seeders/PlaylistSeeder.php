<?php

namespace Database\Seeders;

use App\Models\Playlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $playlists = [
        [
            "name"=> "Favorites",
            "user_id"=> 2
        ],
        [
            "name"=> "My playlist",
            "user_id"=> 1
        ],
        [
            "name"=> "Funny stuff",
            "user_id"=> 2
        ],
        [
            "name"=> "History",
            "user_id"=> 1
        ],
        [
            "name"=> "History",
            "user_id"=> 2
        ],
        [
            "name"=> "History",
            "user_id"=> 3
        ],
        [
            "name"=> "History",
            "user_id"=> 4
        ],
        [
            "name"=> "Liked videos",
            "user_id"=> 1
        ],
        [
            "name"=> "Liked videos",
            "user_id"=> 2
        ],
        [
            "name"=> "Liked videos",
            "user_id"=> 3
        ],
        [
            "name"=> "Liked videos",
            "user_id"=> 4
        ]
    ];

    public function run(): void
    {
        //
        foreach ($this->playlists as $playlist){
            Playlist::create($playlist);
        }
    }
}
