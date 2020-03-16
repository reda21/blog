<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    $username = $faker->userName;
    $sexe = array('m', 'f');
    $rand_keys = array_rand($sexe, 1);
    $data =  [
        "user_id" => 1,
        "sexe" => $sexe[$rand_keys],
        "location" => "default",
        "bio" => $faker->text,
        "twitter_username" => $username,
        "facebook_username" => $username,
        "google_plus_username" => $username,
        "pinterest_username" => $username,
        "dribbble_username" => $username,
        "url" => $faker->url
    ];
    return $data;
});
