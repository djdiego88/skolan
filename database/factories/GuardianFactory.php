<?php

use Faker\Generator as Faker;

$factory->define(
    App\Guardian::class, function (Faker $faker) {
        $marital_status = ['married','single','divorced','common-law','widowed' ,'engaged'];
        $studies = ['primary','highschool','college','professional','specialization' ,'master' ,'doctorate'];
        return [
            'occupation' => $faker->optional($weight = 0.7)->jobTitle,
            'marital_status' => $faker->randomElement($marital_status),
            'studies' => $faker->randomElement($studies),
            'neighborhood' => $faker->optional($weight = 0.7)->streetName,
            'socioeconomic_level' => $faker->numberBetween(1, 6),
            'commune' => $faker->optional($weight = 0.7)->state,
        ];
    }
);
