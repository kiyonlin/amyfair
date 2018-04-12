<?php

use Faker\Generator as Faker;

$factory->define(App\Modules\Exhibition\Exhibition::class, function (Faker $faker) {
    return [
        'name'             => $faker->name,
        'name_en'          => $faker->name,
        'address'          => $faker->address,
        'address_en'       => $faker->address,
        'main_products'    => $faker->sentence,
        'main_products_en' => $faker->sentence,
        'start_at'         => now()->addMonth(),
        'end_at'           => now()->addMonth()->addDays(3),
    ];
});
