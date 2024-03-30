<?php

namespace Database\Seeders;

use App\Models\VideoCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $videoCategories = [
        [
            "video_id" => 1,
            "category_id"=>2
        ],
        [
            "video_id" => 1,
            "category_id"=>7
        ],
        [
            "video_id" => 2,
            "category_id"=>2
        ],
        [
            "video_id" => 3,
            "category_id"=>6
        ],
        [
            "video_id" => 4,
            "category_id"=>6
        ],
        [
            "video_id" => 5,
            "category_id"=>6
        ],
        [
            "video_id" => 6,
            "category_id"=>10
        ],
        [
            "video_id" => 7,
            "category_id"=>10
        ],
        [
            "video_id" => 8,
            "category_id"=>6
        ],
        [
            "video_id" => 9,
            "category_id"=>6
        ],
        [
            "video_id" => 10,
            "category_id"=>2
        ],
        [
            "video_id" => 11,
            "category_id"=>2
        ],
        [
            "video_id" => 12,
            "category_id"=>1
        ],
        [
            "video_id" => 13,
            "category_id"=>2
        ],
        [
            "video_id" => 14,
            "category_id"=>10
        ],
        [
            "video_id" => 15,
            "category_id"=>10
        ],
        [
            "video_id" => 16,
            "category_id"=>4
        ],
        [
            "video_id" => 17,
            "category_id"=>19
        ],
        [
            "video_id" => 18,
            "category_id"=>17
        ],
        [
            "video_id" => 19,
            "category_id"=>3
        ],
        [
            "video_id" => 20,
            "category_id"=>5
        ]
    ];

    public function run(): void
    {
        //
        foreach ($this->videoCategories as $videoCategory){
            DB::table('video_category')->insert($videoCategory);
        }
    }
}
