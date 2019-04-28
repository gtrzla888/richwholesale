<?php

use App\PVCShutter;
use App\BasswoodShutter;
use Faker\Generator as Faker;

$factory->define(BasswoodShutter::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'width' => $faker->numberBetween(1000),
        'drop' => $faker->numberBetween(1200),
        'shutter_type' => 'Bifold Track',
        'corner' => 'No',
        'panel_layout' => 'LRR',
        'panel_qty' => 2,
        'in_or_out' => 'In',
        'colour' => 'W107 Pearl',
        'mid_rail' => 'n/a',
        'mid_rail_height' => 'n/a',
        'blade_size' => '64mm',
        'tilt_rod' => 'Clear View',
        'stile_type' => '50b',
        'frame' => 'FL50-B9',
        'frame_options' => 'LRTB',
        'install_method' => 'Hinged',
        'hinge_type' => 'NM Higne',
        'hinge_colour' => 'Hinge Colour',
    ];
});

$factory->define(PVCShutter::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'width' => $faker->numberBetween(1000),
        'drop' => $faker->numberBetween(1200),
        'shutter_type' => 'Bifold Track',
        'corner' => 'No',
        'panel_layout' => 'LR',
        'panel_qty' => 2,
        'in_or_out' => 'In',
        'colour' => 'white',
        'mid_rail' => 'n/a',
        'mid_rail_height' => 'n/a',
        'blade_size' => '64mm',
        'tilt_rod' => 'Clear View',
        'stile_type' => '50b',
        'frame' => 'FL50-B9',
        'frame_options' => 'LRTB',
        'install_method' => 'Hinged',
        'hinge_type' => 'NM Higne',
        'hinge_colour' => 'Hinge Colour',
    ];
});
