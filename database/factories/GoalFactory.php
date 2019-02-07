<?php

use App\Entities\Course;
use Faker\Generator as Faker;

$factory->define(App\Entities\Goal::class, function (Faker $faker) {
    return [
        'course_id' => Course::all()->random()->id,
        'goal'      => $faker->sentence,
    ];
});
