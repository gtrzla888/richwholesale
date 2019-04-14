<?php

use Faker\Generator as Faker;
use App\Order;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'po_reference' => $faker->uuid,
        'company_id' => 1,
        'status' => 'completed',
        'note' => $faker->words
    ];
});
