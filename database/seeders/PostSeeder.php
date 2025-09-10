<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
    
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    
    public function run()
    {
        $posts = Post::factory(8)->create();
        foreach($posts as $post){
            Image::factory(1)->create([
                'imageable_id' => $post->id,
                'imageable_type' => Post::class]);
            $post->tags()->attach([
                rand(1,4),//1 etiqueta al azar
                rand(5,8) //2 etiqueta al azar
            ]);

        }
    }
}
