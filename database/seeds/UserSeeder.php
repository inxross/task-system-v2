<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'test1',
                'email' => 'test1@example.com',
                'password' => bcrypt('password123'),
                'api_token' => Str::random(60),
            ],
            [
                'name' => 'test2',
                'email' => 'test2@example.com',
                'password' => bcrypt('password123'),
                'api_token' => Str::random(60),
            ],
            [
                'name' => 'test3',
                'email' => 'test3@example.com',
                'password' => bcrypt('password123'),
                'api_token' => Str::random(60),
            ],
            [
                'name' => 'test4',
                'email' => 'test4@example.com',
                'password' => bcrypt('password123'),
                'api_token' => Str::random(60),
            ],
            [
                'name' => 'test5',
                'email' => 'test5@example.com',
                'password' => bcrypt('password123'),
                'api_token' => Str::random(60),
            ],
        ]);
    }
}
