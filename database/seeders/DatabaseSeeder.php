<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // 1: clear the current tables
        DB::table('users')->delete();
        DB::table('posts')->delete();

        // seed users
        \App\Models\User::factory(10)->create();

        // seed user posts
        \App\Models\Post::factory(20)->create();

    }
}
