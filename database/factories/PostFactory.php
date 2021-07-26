<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
  
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => function (){
                return User::factory()->create()->id;
            },
            'body' =>   $this->faker->sentence(2),
        ];
    }
}
