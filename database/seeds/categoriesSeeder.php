<?php

use Illuminate\Database\Seeder;
use App\Category;
class categoriesSeeder extends Seeder
{

    public function run()
    {
        DB::table('categories')->delete();

        $categories = [
            ['id' => '1', 'name' => 'Action', 'description' => "Action you won't get bored"],
            ['id' => '2','name' => 'Comedy', 'description' => 'Laugh at life with these movies'],
            ['id' => '3','name' => 'Romance', 'description' => 'Fall in love with life'],
            ['id' => '4','name' => 'Drama', 'description' => 'Watch dramatic stories'],
            ['id' => '5','name' => 'Horror', 'description' => "you'll be scared with this histories"],
        ];

        foreach($categories as $category){
            Category::create($category);

        }
    }
}
