<?php

use Faker\Generator as Faker;
use App\Shutter;

$factory->define(Shutter::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'width' => $faker->numberBetween(1000),
        'drop' => $faker->numberBetween(1200),
        'corner' => 'no',
        'panel_layout' => 'LR',
        'panel_qty' => 2,
        'in_or_out' => 'In',
        'mid_rail_height' => 'n/a',
        'blade_size' => $faker->numberBetween(89),
        'tilt_rod' => 'clear view',
        'stile_type' => '50b',
        'frame' => 'FL50-B9',
        'frame_options' => 'LRTB',
        'install_method' => 'Hinged',
        'hinge_type' => 'NM Higne',
        'hinge_colour' => 'Hinge Colour',
        'type' => Shutter::$shutterTypes[array_rand(Shutter::$shutterTypes,1)]
    ];
});
