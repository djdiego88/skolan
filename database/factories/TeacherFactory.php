<?php

use Faker\Generator as Faker;

$factory->define(App\Teacher::class, function (Faker $faker) {
    return [
        'acronym' => $faker->lexify('????'),
        'area_id' => $faker->numberBetween(1, 10),
        'profession' => $faker->jobTitle,
        'experience' => $faker->text(),
        'applied_studies' => $faker->text(),
        'scale' => $faker->bothify('##??#'), // secret
        'resolution' => $faker->bothify('#### de ##'),
    ];
});
