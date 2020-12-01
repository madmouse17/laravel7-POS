<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'alamat' => $faker->address,
        'telp' => $faker->randomDigit,
    ];
});