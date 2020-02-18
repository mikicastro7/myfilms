<?php

use Illuminate\Database\Seeder;
use App\User;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        $users = [
            ['id' => '1', 'name' => 'miquel', 'email' => "castro-miquel@hotmail.com", "password" => '$2y$10$8jhB8Tt/VNgGON0eZRWkCudmJIiL1sj2u2yueitvuhOcDNSIPWVy.', "type" => '0'],
            ['id' => '2', 'name' => 'miquel', 'email' => "castro-miquel2@hotmail.com", "password" => '$2y$10$8jhB8Tt/VNgGON0eZRWkCudmJIiL1sj2u2yueitvuhOcDNSIPWVy.' , "type" => '1'],
            ['id' => '3', 'name' => 'miquel', 'email' => "castro-miquel3@hotmail.com", "password" => '$2y$10$8jhB8Tt/VNgGON0eZRWkCudmJIiL1sj2u2yueitvuhOcDNSIPWVy.', "type" => '2'],

        ];
        foreach($users as $user){
            User::create($user);
        }
    }
}
