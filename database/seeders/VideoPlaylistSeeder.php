<?php

namespace Database\Seeders;

use App\Models\VideoPlaylist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoPlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $videoPlaylists = [
      [
          "playlist_id"=>1,
          "video_id"=>6
      ],
      [
          "playlist_id"=>2,
          "video_id"=>12
      ],
      [
          "playlist_id"=>2,
          "video_id"=>14
      ],
      [
          "playlist_id"=>2,
          "video_id"=>17
      ],
      [
          "playlist_id"=>3,
          "video_id"=>5
      ],
      [
          "playlist_id"=>4,
          "video_id"=>8
      ],
      [
          "playlist_id"=>4,
          "video_id"=>20
      ],
      [
          "playlist_id"=>1,
          "video_id"=>9
      ]
    ];

    public function run(): void
    {
        //
        foreach ($this->videoPlaylists as $playlist){
            DB::table('video_playlist')->insert($playlist);
        }
    }
}
