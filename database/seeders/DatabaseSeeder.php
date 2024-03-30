<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Playlist;
use App\Models\Reaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            ReactionSeeder::class,
            CountrySeeder::class,
            UserSeeder::class,
            VideoSeeder::class,
            CommentSeeder::class,
            PlaylistSeeder::class,
            SubscriptionSeeder::class,
            VideoReactionSeeder::class,
            CommentReactionSeeder::class,
            VideoCategorySeeder::class,
            MenuSeeder::class,
            VideoPlaylistSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
