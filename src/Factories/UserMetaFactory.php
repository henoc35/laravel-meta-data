<?php

use CityHunter\LaravelMetaData\Tests\Models\User;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;

$factory->define(\CityHunter\LaravelMetaData\Models\UserMeta::class, function (Generator $faker) {
    return [
        'user_id' => 1,
        'meta_value' => $faker->name(),
        'meta_key' => \Illuminate\Support\Str::slug($faker->name()),
    ];
});
