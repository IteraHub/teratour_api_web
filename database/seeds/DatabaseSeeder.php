<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,5)->create()
            ->each(function($user){
                factory(App\Post::class,2)->create(['user_id'=>$user->id])
                    ->each(function($post){
                        factory(App\Comment::class,2)->create(['user_id'=>$post->user_id,'post_id'=>$post->id]);
                    });
            });
    }
}
