<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{

    public function run()
    {
        $posts = [
            [
                'title' => 'Cali Renace',
                'slug' => 'cali-renace',
                'extract' => 'videojuego desarrollado para la universidad AUNAR como proyecto de grado de ingenieria',
                'body' => 'videojuego desarrollado para la universidad AUNAR como proyecto de grado de ingenieria',
                'status' => 1,
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => '2025-09-10 14:20:49',
                'updated_at' => '2025-09-10 14:20:49',
            ],
            [
                'title' => 'austin',
                'slug' => 'austin',
                'extract' => '',
                'body' => '123',
                'status' => 1,
                'category_id' => 1,
                'user_id' => 2,
                'created_at' => '2025-09-11 13:30:19',
                'updated_at' => '2025-09-11 13:30:19',
            ],
            [
                'title' => 'Boom',
                'slug' => 'boom',
                'extract' => '',
                'body' => 'videogame created at my 18 in the high school, in a group called club smart',
                'status' => 1,
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => '2025-09-11 13:46:43',
                'updated_at' => '2025-09-11 13:46:43',
            ],
            [
                'title' => 'Simulador Emprende',
                'slug' => 'simulador-emprende',
                'extract' => 'Second videogame as a grade project of unicatolica university',
                'body' => 'Video games have experienced tremendous popularity worldwide thanks to the advanced technology they have developed. Often, video games aren\'t just created for entertainment; they have also been able to generate different, fun ways to learn while also being entertaining. There are learning games that use puzzles to help you solve these problems, either by providing clues or suggestions.',
                'status' => 1,
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => '2025-09-11 13:53:37',
                'updated_at' => '2025-09-11 13:53:37',
            ],
            [
                'title' => 'Cali Renace Videojuego civico de Cali (2025 08 23)',
                'slug' => 'cali-renace-videojuego-civico-de-cali-2025-08-23',
                'extract' => '',
                'body' => 'Individual responsibility contributes positively to the city\'s reputation. Despite the challenges, every resident must begin to act differently, embracing Cali\'s diversity. The city has the potential to be better than it was in the 1970s, and by actively contributing, we can forge a diverse, united, and civilized Cali that will be remembered and fill us with pride.',
                'status' => 1,
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => '2025-09-11 13:56:59',
                'updated_at' => '2025-09-11 13:56:59',
            ],
            [
                'title' => 'Cali Renace Levels',
                'slug' => 'cali-renace-levels',
                'extract' => '',
                'body' => 'Scenes of video game',
                'status' => 1,
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => '2025-09-11 14:20:44',
                'updated_at' => '2025-09-11 14:20:44',
            ],
            [
                'title' => 'First creation',
                'slug' => 'first-creation',
                'extract' => '',
                'body' => 'Construct 2 is a game engine and development tool designed to create 2D games without needing to write traditional code. It uses a visual, drag-and-drop interface with event-based logic, which makes it very beginner-friendly.',
                'status' => 1,
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => '2025-09-11 14:23:36',
                'updated_at' => '2025-09-11 14:23:36',
            ],
            [
                'title' => 'Login',
                'slug' => 'login',
                'extract' => '',
                'body' => 'this is the logo of login of this app',
                'status' => 1,
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => '2025-09-11 14:24:32',
                'updated_at' => '2025-09-11 14:24:32',
            ],
            [
                'title' => 'Corsa Racer Template',
                'slug' => 'corsa-racer-template',
                'extract' => '',
                'body' => 'it\'s from a template what I\'ve use before',
                'status' => 1,
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => '2025-09-11 14:25:45',
                'updated_at' => '2025-09-11 14:25:45',
            ],
            [
                'title' => 'future teamwork',
                'slug' => 'future-teamwork',
                'extract' => '',
                'body' => 'I ask to God for this desire',
                'status' => 1,
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => '2025-09-11 14:26:55',
                'updated_at' => '2025-09-11 14:26:55',
            ],
            [
                'title' => 'Juan Great Developer',
                'slug' => 'juan-great-developer',
                'extract' => '',
                'body' => 'he had win the price of year\'s engineer',
                'status' => 1,
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => '2025-09-11 14:28:11',
                'updated_at' => '2025-09-11 14:28:11',
            ],
            [
                'title' => 'youtube channel',
                'slug' => 'youtube-channel',
                'extract' => '',
                'body' => 'https://www.youtube.com/@josedanielgrijalbaosorio7431',
                'status' => 1,
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => '2025-09-11 14:29:33',
                'updated_at' => '2025-09-11 14:29:33',
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
        $createdPosts = Post::all();
        $images = [
            '/images/uploads/1757514049_team-0.jpg',
            '/images/uploads/1757597419_Austin.jpg',
            '/images/uploads/1757598403_boom.jpg',
            '/images/uploads/1757598817_scenes.png',
            '/images/uploads/1757599019_op.jpg',
            '/images/uploads/1757600444_op (1).png',
            '/images/uploads/1757600616_BOOM.png',
            '/images/uploads/1757600672_2background-new.png',
            '/images/uploads/1757600745_new-1.jpg',
            '/images/uploads/1757600815_team.png',
            '/images/uploads/1757600891_40.JUAN.jpg',
            '/images/uploads/1757600973_bomm.png',
        ];

        foreach ($createdPosts as $index => $post) {
            if (isset($images[$index])) {
                $post->image()->create([
                    'url' => $images[$index],
                ]);
            }
        }
        // $posts = Post::factory(8)->create();
        // foreach($posts as $post){
        //     Image::factory(1)->create([
        //         'imageable_id' => $post->id,
        //         'imageable_type' => Post::class]);
        //     $post->tags()->attach([
        //         rand(1,4),//1 etiqueta al azar
        //         rand(5,8) //2 etiqueta al azar
        //     ]);

        // }
    }
}
