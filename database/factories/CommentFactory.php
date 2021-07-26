<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
   
    protected $model = Comment::class;

  
    public function definition()
    {
        return [
            'user_id' => function (){
                return User::factory()->create()->id;
            },
            'post_id' => function (){
                return Post::factory()->create()->id;
            },
            'body' =>   $this->faker->sentence(2),
        ];
    }
}
