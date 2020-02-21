<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(\App\Models\User::class, function (Faker $faker) {
    $password = "bejaia21";
    $input = array('m', 'f');
    $gender = array('male', 'female');
    $rand_keys = array_rand($input, 1);
    $array = [
        "username" => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        "email_show" => 0,
        'password' => bcrypt($password),
        "email_verified_at" => Carbon::now(),
        'first_name' => $faker->firstName($gender[$rand_keys]),
        'last_name' => $faker->lastName($gender[$rand_keys]),
    ];


    return $array;

});
