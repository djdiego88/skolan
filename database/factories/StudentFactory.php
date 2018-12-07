<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
    $blood_type = ['A+','A-','B+','B-','AB+' ,'AB-' ,'O+' ,'O-'];
    return [
        'neighborhood' => $faker->optional($weight = 0.7)->streetName,
        'socioeconomic_level' => $faker->numberBetween(1, 6),
        'commune' => $faker->optional($weight = 0.7)->state,
        'health_care' => $faker->sentence(3),
        'blood_type' => $faker->randomElement($blood_type),
        'allergies' => $faker->optional($weight = 0.7)->text(),
        'diseases' => $faker->optional($weight = 0.7)->text(),
    ];
});
