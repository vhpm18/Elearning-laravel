<?php

use App\Entities\Category;
use App\Entities\Course;
use App\Entities\Level;
use App\Entities\Teacher;
use Faker\Generator as Faker;
use Faker\Provider\Image;

$factory->define(App\Entities\Course::class, function (Faker $faker) {
    $name   = $faker->sentence;
    $status = $faker->randomElement(
        [
            Course::PUBLISHED, Course::PENDING, Course::REJECTED,
        ]
    );
    return [
        'teacher_id'        => Teacher::all()->random()->id,
        'category_id'       => Category::all()->random()->id,
        'level_id'          => Level::all()->random()->id,
        'name'              => $name,
        'description'       => $faker->paragraph,
        'slug'              => str_slug($name, '-'),
        'picture'           => Image::image(storage_path() . '/app/public/courses', 600, 350, 'business', false),
        'status'            => $status,
        'previous_approved' => $status !== Course::PUBLISHED ? false : true,
        'previous_rejected' => $status === Course::REJECTED ? true : false,

    ];
});
