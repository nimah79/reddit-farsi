<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'nimah79',
            'email' => 'nima.heydari79@yahoo.com',
            'password' => bcrypt('Galaxynote8.0'),
        ]);
        User::factory(10)->create();
        Community::factory(1)->create();
        Post::factory(50)->create();
    }
}
