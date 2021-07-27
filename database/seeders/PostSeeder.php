<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
   
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Post::truncate();
        Comment::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $posts = Post::factory(10)->create([
            'user_id' =>  User::all()->random()->id,
        ]);

        foreach ($posts as  $post) {
            
            Comment::factory(30)->create([
                'user_id' => User::all()->random()->id,
                'post_id' => Post::all()->random()->id,
            ]);
        }



    }
}
