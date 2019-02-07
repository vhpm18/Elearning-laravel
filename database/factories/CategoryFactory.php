<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Category::class, function (Faker $faker) {
    return [
        'name'        => $faker->RandomElement(
            ['PHP', 'JAVASCRIPT', 'JAVA', 'SQL', 'POO', 'PHYTON', 'C++', 'NOSQL', 'BIGDATA', 'DESEÑO WEB', 'LINUX', 'SERVIDORES', 'AMAZON WEB SERVICES']
        ),
        'description' => $faker->sentence,
    ];
});
