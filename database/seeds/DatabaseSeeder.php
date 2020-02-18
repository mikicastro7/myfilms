<?php

use Illuminate\Database\Seeder;
use app\Movie;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        $this->call(usersSeeder::class);
        $this->call(categoriesSeeder::class);
        $this->call(moviesSeeder::class);
    }
}
