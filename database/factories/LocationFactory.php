<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Location;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Location::class, function (Faker $faker) {
    return [
        "city"=> Str::random(10),
        "state"=>"Morelos",
        "country"=> "Mexico",
        "zip_code"=> "62448",
        "address"=> "Boulevard Díaz Ordaz No. 9 Cantarranas",
    ];
});
