<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $categories = [
        "Music",
        "Entertainment",
        "Gaming",
        "Sports",
        "News",
        "Comedy",
        "Education",
        "How-to & Style",
        "Science & Technology",
        "Film & Animation",
        "Pets & Animals",
        "Travel & Events",
        "Autos & Vehicles",
        "Beauty & Fashion",
        "Food & Drink",
        "Health & Fitness",
        "Kids",
        "Lifestyle",
        "Business & Finance",
        "Art & Culture"
    ];

    public function run(): void
    {
        //
        foreach ($this->categories as $category){
            Category::create([
               "name"=>$category
            ]);
        }

    }
}
