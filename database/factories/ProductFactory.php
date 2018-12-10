<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'price' => $faker->randomFloat(2,1,100),
    ];
});
