<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use \App\Models\Category ;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //clearing the data before seeding

        Post::factory(10)->create();
        Post::factory(2)->create(['category_id'=>1 , 'user_id'=>1]);
        Post::factory(4)->create(['category_id'=>1 , 'user_id'=>2]);
        Post::factory(3)->create(['category_id'=>2 , 'user_id'=>2]);
        Post::factory(2)->create(['category_id'=>2 , 'user_id'=>1]);
        Comment::factory(5)->create(['post_id'=>1]);


    }
}
