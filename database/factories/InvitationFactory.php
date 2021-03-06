<?php

use Faker\Generator as Faker;
use App\Modules\Exhibition\Exhibition;

$factory->define(App\Modules\Invitation\Invitation::class, function (Faker $faker) {
    return [
        'type'         => $faker->randomElement(['supplier', 'buyer']),
        'email'        => $faker->email,
        'mobile'       => $faker->phoneNumber,
        'passportNo'   => $faker->word,
        'visaType'     => $faker->randomElement(['work', 'student', 'tourist']),
        'fullName'     => $faker->name,
        'country'      => $faker->country,
        'industry'     => $faker->word,
        'gender'       => $faker->randomElement(['male', 'female']),
        'phone'        => $faker->phoneNumber,
        'qq'           => $faker->word,
        'wechat'       => $faker->word,
        'whatsapp'     => $faker->word,
        'skype'        => $faker->word,
        'facebook'     => $faker->word,
        'corpName'     => $faker->company,
        'corpAddr'     => $faker->address,
        'website'      => $faker->url,
        'source'       => $faker->word,
        'intent'       => function () {
            return create(Exhibition::class)->id;
        },
        'tradingIntro' => $faker->sentence,
        'admin_id'     => null,
    ];
});
