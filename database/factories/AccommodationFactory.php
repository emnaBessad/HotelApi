<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Accommodation;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Accommodation::class, function (Faker $faker) {
    return [
        "name"=>Str::random(10),
        "rating"=> rand(1,5),
        "category"=> "hotel",
        "location_id"=> function () {
            return factory(App\Location::class)->create()->id;
        },
        "image"=> "https://helpx.adobe.com/content/dam/help/en/stock/how-to/visual-reverse-image-search/jcr_content/main-pars/image/visual-reverse-image-search-v2_intro.jpg",
        "reputation"=> rand(1,1000),
        "price"=> 1000,
        "availability"=> 1
    ];
});
