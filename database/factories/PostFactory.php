<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\Category;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $categoryId = App\Category::pluck('id')->toArray();
    return [
        'category_id' => $faker->randomElement($categoryId),
        'title' => $faker->sentence($nbWords = random_int(1,5), $variableNbWords = true),
        'author' => $faker->name,
    ];
});
