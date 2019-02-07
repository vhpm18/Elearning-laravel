<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Student::class, function (Faker $faker) {
    return [
        'user_id' => null,
        'title'   => $faker->jobTitle,
    ];
});
