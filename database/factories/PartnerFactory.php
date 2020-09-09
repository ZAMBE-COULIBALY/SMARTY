<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Partner;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Partner::class, function (Faker $faker) {
    return [
        //
        'code'=> Str::random(10),
        'label'=> $faker->name,
        'email'=> $faker->email,
        'contact'=> $faker->phoneNumber,
        'state'=> $faker->boolean(),
        'slug'=> Str::random(10),

    ];
});
