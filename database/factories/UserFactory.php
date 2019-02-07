<?php

use App\Entities\Role;
use App\Entities\User;
use Faker\Generator as Faker;
use Faker\Provider\Image;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(User::class, function (Faker $faker) {
    $name      = $faker->name;
    $last_name = $faker->lastName;

    return [
        'role_id'        => Role::all()->random()->id,
        'name'           => $name,
        'last_name'      => $last_name,
        'slug'           => str_slug($name . " " . $last_name, '-'),
        'email'          => $faker->unique()->safeEmail,
        'password'       => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'picture'        => Image::image(storage_path() . '/app/public/users', 200, 200, 'people', false),
        'remember_token' => str_random(10),
    ];
});
