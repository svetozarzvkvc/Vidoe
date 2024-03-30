<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        //

        $videos = [

            [
                "title" => "Me at the zoo",
                "src" => "videoplayback1.mp4",
                "duration" => 19.06,
                "description" => "My first video.",
                "thumbnail" => "thumbnail1.jpg",
                "size" => 791367,
                "user_id" => 1,
                "total_views"=>10000
            ],
            [
                "title" => "DOOR STUCK! DOOR STUCK!",
                "src" => "videoplayback2.mp4",
                "duration" => 34.78,
                "description" => "Me having fun in ESEA.",
                "thumbnail" => "thumbnail2.jpg",
                "size" => 2353403,
                "user_id" => 2,
                "total_views"=>24500
            ],
            [
                "title" => "Family guy funniest moment #1",
                "src" => "videoplayback3.mp4",
                "duration" => 11.58,
                "description" => "Very funny family guy video.",
                "thumbnail" => "thumbnail3.jpg",
                "size" => 377641,
                "user_id" => 3,
                "total_views"=>12500
            ],
            [
                "title" => "Old man vapes and dies",
                "src" => "videoplayback4.mp4",
                "duration" => 18.71,
                "description" => "Old man trying vape for the first time.",
                "thumbnail" => "thumbnail4.jpg",
                "size" => 882381,
                "user_id" => 3,
                "total_views"=>45982
            ],
            [
                "title" => "The Schwarzeneggers of the Ring Part 2",
                "src" => "videoplayback5.mp4",
                "duration" => 71.65,
                "description" => "Featuring the iconic “one does not simply…” scene and a hilarious ending I’m very proud of.",
                "thumbnail" => "thumbnail5.jpg",
                "size" => 3396716,
                "user_id" => 3,
                "total_views"=>98123
            ],
            [
                "title" => "Tobey Maguire's Paparazzi Rage",
                "src" => "videoplayback6.mp4",
                "duration" => 39.28,
                "description" => "Tobey Maguire's Paparazzi Rage But With Spiderman 3 Music.",
                "thumbnail" => "thumbnail6.jpg",
                "size" => 2025489,
                "user_id" => 3,
                "total_views"=>78645
            ],
            [
                "title" => "Are You wearing Wire | The Sopranos",
                "src" => "videoplayback7.mp4",
                "duration" => 59.67,
                "description" => "Paulie checks Christopher for wire.",
                "thumbnail" => "thumbnail7.jpg",
                "size" => 2011267,
                "user_id" => 3,
                "total_views"=>12463
            ],
            [
                "title" => "Berta Loses Her Bet With Charlie | Two and a Half Men",
                "src" => "videoplayback8.mp4",
                "duration" => 80.17,
                "description" => "Season 7 Episode 11: Warning, It's Dirty.",
                "thumbnail" => "thumbnail8.jpg",
                "size" => 4635134,
                "user_id" => 3,
                "total_views"=>25468
            ],
            [
                "title" => "Daily funny memes #109",
                "src" => "videoplayback9.mp4",
                "duration" => 59.46,
                "description" => "Daily dose of funny memes.",
                "thumbnail" => "thumbnail9.jpg",
                "size" => 1588393,
                "user_id" => 3,
                "total_views"=>130452
            ],
            [
                "title" => "Family guy - you speak english?",
                "src" => "videoplayback10.mp4",
                "duration" => 21.80,
                "description" => "From the episode Road to Rhode Island",
                "thumbnail" => "thumbnail10.jpg",
                "size" => 1622638,
                "user_id" => 4,
                "total_views"=>21452
            ],
            [
                "title" => "Impractical jokers - Savage Cashiers",
                "src" => "videoplayback11.mp4",
                "duration" => 77.69,
                "description" => "Impractical jokers funny moment.",
                "thumbnail" => "thumbnail11.jpg",
                "size" => 13675829,
                "user_id" => 3,
                "total_views"=>64312
            ],
            [
                "title" => "Kanye West - Gaga's camera",
                "src" => "videoplayback12.mp4",
                "duration" => 13.69,
                "description" => "",
                "thumbnail" => "thumbnail12.jpg",
                "size" => 693282,
                "user_id" => 3,
                "total_views"=>43634
            ],
            [
                "title" => "Compton Magic Tricks: Street Magic | David Blaine",
                "src" => "videoplayback13.mp4",
                "duration" => 118.00,
                "description" => "David Blaine magically switches cards from a mans hands.",
                "thumbnail" => "thumbnail13.jpg",
                "size" => 6208499,
                "user_id" => 3,
                "total_views"=>72341
            ],
            [
                "title" => "South Park - City Wok vs City Sushi",
                "src" => "videoplayback14.mp4",
                "duration" => 122.50,
                "description" => "From the episode 'City Sushi'
                 South Park - Season 15 Episode 6",
                "thumbnail" => "thumbnail14.jpg",
                "size" => 3383177,
                "user_id" => 4,
                "total_views"=>26523
            ],
            [
                "title" => "South Park How Chinese People view to the Japanese",
                "src" => "videoplayback15.mp4",
                "duration" => 67.94,
                "description" => "Lu Kim, the owner of City Wok invited City sushi owner, Junichi Takayama to a school meeting claiming it to be about the diversity of Asian people.  Little does Takayama know is that the meeting would be a trap to embarrass him.",
                "thumbnail" => "thumbnail15.jpg",
                "size" => 2460046,
                "user_id" => 4,
                "total_views"=>61345

            ],
            [
                "title" => "Tennis but it's Ping Pong",
                "src" => "videoplayback16.mp4",
                "duration" => 35.36,
                "description" => "Two guys playing tennis on a ping pong table.",
                "thumbnail" => "thumbnail16.jpg",
                "size" => 3095872,
                "user_id" => 4,
                "total_views"=>43773
            ],
            [
                "title" => "The Best Scene in The Wolf of Wall Street",
                "src" => "videoplayback17.mp4",
                "duration" => 217.64,
                "description" => "My favorite scene in The Wolf of Wall Street.",
                "thumbnail" => "thumbnail17.jpg",
                "size" => 9429410,
                "user_id" => 4,
                "total_views"=>72341
            ],
            [
                "title" => "A rabbit having fun",
                "src" => "videoplayback18.mp4",
                "duration" => 10.02,
                "description" => "Just a rabbit jumping around having fun.",
                "thumbnail" => "thumbnail18.jpg",
                "size" => 788493,
                "user_id" => 4,
                "total_views"=>56329
            ],
            [
                "title" => "GTA Vice City Theme",
                "src" => "videoplayback19.mp4",
                "duration" => 79.62,
                "description" => "GTA Vice City Theme song.",
                "thumbnail" => "thumbnail19.jpg",
                "size" => 1980923,
                "user_id" => 3,
                "total_views"=>34634

            ],
            [
                "title" => "Putin shoots everyone",
                "src" => "videoplayback20.mp4",
                "duration" => 32.67,
                "description" => "Funny Putin meme.",
                "thumbnail" => "thumbnail20.jpg",
                "size" => 2310101,
                "user_id" => 4,
                "total_views"=>634624
            ]
        ];

        foreach ($videos as $video){
            Video::create($video);
        }
    }
}
