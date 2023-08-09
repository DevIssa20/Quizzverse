<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Quizze;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'John',
            'email' => 'John@gmail.com'
        ]);

        Quizze::create([
            'user_id' => $user->id,
            'title' => "My First Quiz",
            'description' => "Welcome to my first quiz",
            'tags' => "test, debugging, suii",
            'private' => false,
        ]);

        Quizze::create([
            'user_id' => $user->id,
            'title' => "My Second Quiz",
            'description' => "Welcome to my second quiz",
            'tags' => "test, debugging, hello",
            'private' => true,
        ]);

        Quizze::create([
            'user_id' => $user->id,
            'title' => "My Third Quiz",
            'description' => "Welcome to my third quiz",
            'tags' => "test, debugging, hello",
            'private' => false,
        ]);

        Quizze::create([
            'user_id' => $user->id,
            'title' => "My Fourth Quiz",
            'description' => "Welcome to my fourth quiz",
            'tags' => "test, debugging, hello",
            'private' => false,
        ]);

        Quizze::create([
            'user_id' => $user->id,
            'title' => "My Fifth Quiz",
            'description' => "Welcome to my fifth quiz",
            'tags' => "test, debugging, hello",
            'private' => false,
        ]);

        Quizze::create([
            'user_id' => $user->id,
            'title' => "My Sixth Quiz",
            'description' => "Welcome to my sixth quiz",
            'tags' => "test, debugging, hello",
            'private' => false,
        ]);

        Quizze::create([
            'user_id' => $user->id,
            'title' => "My Seventh Quiz",
            'description' => "Welcome to my seventh quiz",
            'tags' => "test, debugging, hello",
            'private' => false,
        ]);

        Quizze::create([
            'user_id' => $user->id,
            'title' => "My Eighth Quiz",
            'description' => "Welcome to my eighth quiz",
            'tags' => "test, debugging, hello",
            'private' => false,
        ]);

        Quizze::create([
            'user_id' => $user->id,
            'title' => "My Ninth Quiz",
            'description' => "Welcome to my ninth quiz",
            'tags' => "test, debugging, hello",
            'private' => false,
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
