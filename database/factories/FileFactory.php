<?php

use App\Contact;
use App\File;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(File::class, function (Faker $faker) {
    return [
        'contact_id' => function () {
            return Contact::factory()->create()->id;
        },
        'file'       => $faker->imageUrl(),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
