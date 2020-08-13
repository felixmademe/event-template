<?php

/** @var Factory $factory */

use App\Participant;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Participant::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'birth_date' => $faker->date(),
        'event_id' => $faker->numberBetween( 1, 10 ),
    ];
});
