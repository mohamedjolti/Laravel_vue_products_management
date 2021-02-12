<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $categories = App\Category::pluck('id')->toArray();

    return [
        'name' => $faker->sentence,
        'description'=>$faker->sentence,
        'price'=>$faker->unique()->randomDigit,
        'image'=>$faker->sentence,
        'category'=>$faker->randomElement($categories)
    ];
});
