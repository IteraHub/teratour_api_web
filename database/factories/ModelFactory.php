<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname'=>$faker->lastName,
        'username'=>$faker->userName,
        'email' => $faker->email,
        'about'=>$faker->paragraph,
        'dob'=>$faker->dateTimeBetween('1990-01-01', '2012-12-31')
                             ->format('d/m/Y'), 
        'image_url'=>"http://res.cloudinary.com/arinzedroid/image/upload/v1523528970/User_Profile_Image/face0.jpg",
        'password'=>\Illuminate\Support\Facades\Hash::make('12345asd'),
        'gender'=>$faker->boolean

    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker){
    return [
        'title'=>$faker->paragraph,
        'text'=>$faker->paragraph,
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker){
    return [
        'text'=>implode('',$faker->paragraphs)
    ];
});
