<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Category::class, function (Faker $faker) {
    //genero con faker la mia frase che utilizzerò per title e slug
    //rimuovo tutti i caratteri non alfanumerici e taglio il punto finale
    /* $fakeSentence = preg_replace("/[^A-Za-z0-9 ]/",'',rtrim($faker->sentence($nbWords = random_int(1,5), $variableNbWords = true),".")); */
    /* return [
        'title' => $fakeSentence,
        'slug' => str_replace(' ','-',$fakeSentence),//sostituisco gli spazi bianchi con i trattini per lasciare lo slug human readable
    ]; */
    $fakeTitle = $faker->sentence($nbWords = random_int(1,5), $variableNbWords = true);
    $fakeSlug = Str::of($fakeTitle)->slug('-');

    return [
        'title' => $fakeTitle,
        'slug' => $fakeSlug,
    ];
});
