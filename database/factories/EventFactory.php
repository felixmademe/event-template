<?php

/** @var Factory $factory */

use App\Event;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'location' => $faker->address,
        'description' => $faker->sentence($nbWords = 100, $variableNbWords = true),
        'public' => $faker->boolean($chanceOfGettingTrue = 60),
        'registration' => $faker->boolean($chanceOfGettingTrue = 70),
        'max_visitors' => $faker->numberBetween( 10, 200 ),
        'start_time' => now(),
        //'mail_release_time' => now()->addDays( 1 ),
        //'registration_close_time' => now()->addDays( 2 ),
        'image_banner' => $faker->randomElement(
            [
                null,
                "https://tinyurl.com/yam4oprg",
                "https://tinyurl.com/ycdw5dto",
                "https://tinyurl.com/y77b2ygk"
            ]
        ),
        'price'  => $faker->numberBetween( 0, 1 ),
    ];
});
