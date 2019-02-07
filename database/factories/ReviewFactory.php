<?php

use App\Entities\Course;
use App\Entities\User;
use Faker\Generator as Faker;

$factory->define(App\Entities\Review::class, function (Faker $faker) {
    return [
        'course_id' => Course::all()->random()->id,
        'user_id'   => User::all()->random()->id,
        'rating'    => $faker->randomFloat(2, 1, 5),
        'comment'   => $faker->paragraph,
    ];
});
