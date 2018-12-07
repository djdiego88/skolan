<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

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

$factory->define(App\User::class, function (Faker $faker) {
    $its = ['RC','TI','CC','CE','PB' ,'NI'];
    $genders = ['male', 'female'];
    $gender = $faker->randomElement($genders);
    $genderabbr = ($gender === 'male') ? 'm' : 'f';
    $statuses = ['enabled', 'disabled'];
    return [
        'it' => $faker->randomElement($its),
        'nid' => $faker->unique()->numerify('##########'),
        'first_name' => $faker->firstName($gender),
        'last_name' => $faker->lastName,
        'email' => $faker->optional($weight = 0.7)->safeEmail,
        'password' => Hash::make($faker->password), // secret
        'birth_date' => $faker->date('Y-m-d'),
        'gender' => $genderabbr,
        'phone_number' => $faker->e164PhoneNumber,
        'cellphone_number' => $faker->optional($weight = 0.7)->e164PhoneNumber,
        'nacionality' => 'CO',
        'location' => 'Bogotá D.C.',
        'address' => $faker->address,
        'photo' => $faker->optional($weight = 0.7)->image('public/storage/images/photos',200,200, 'people', false),
        'status' => $faker->randomElement($statuses),
        'last_access' => $faker->dateTimeThisMonth(),
        'remember_token' => str_random(15),
    ];
});
