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

$factory->define(App\Modules\Auth\User::class, function (Faker $faker) {
    return [
        'name'             => $faker->name,
        'email'            => $faker->unique()->safeEmail,
        'mobile'           => $faker->unique()->phoneNumber,
        'password'         => Hash::make('111111'), // secret
        'forbidden'        => false,
    ];
});

$factory->define(App\Modules\Auth\Admin::class, function (Faker $faker) {
    return [
        'name'             => $faker->name,
        'email'            => $faker->unique()->safeEmail,
        'mobile'           => $faker->unique()->phoneNumber,
        'password'         => Hash::make('111111'), // secret
        'forbidden'        => false,
    ];
});
