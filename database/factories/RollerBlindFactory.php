<?php

use Faker\Generator as Faker;
use App\RollerBlind;

$factory->define(RollerBlind::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'width' => $faker->numberBetween(0, 1000),
        'drop' => $faker->numberBetween(0, 1200),
        'fabric' => 'Solitaire',
        'colour' => 'white',
        'bracket_colour' => 'white',
        'base_rail' => 'silver',
        'roll_direction' => 'standard',
        'control_type' => 'motor',
        'control_side' => 'right',
        'chain_length' => 'n/a',
        'motor_brand' => 'Acemda',
        'motor_type' => 'hard_wired',
        'charger' => 'no',
        'wifi_hub' => 'Yes'
    ];
});

