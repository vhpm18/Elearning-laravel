<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Role::class, function (Faker $faker) {
    return [
        'name'        => $faker->word,
        'description' => $faker->paragraph,
    ];
});
