<?php

namespace App;


use Illuminate\Validation\Rule;

class BasswoodShutter extends Shutter
{
    const NAME = 'Bassword Shutter';

    public static function rules()
    {
        return parent::rules() + [
            'shutter_type' => [
                'required',
            ],
            'corner' => [
                'required'
            ],
            'panel_layout' => [
                'required',
                'regex:/^[C|D|L|R|T|-]+$/'
            ],
            'in_or_out' => [
                'required',
                Rule::in('in', 'out')
            ],
            'mid_rail' => [
                'required'
            ],
            'mid_rail_height' => [

            ],
            'blade_size' => 'required',
            'tilt_rod' => 'required',
            'color' => [
                'required'
            ],
            'stile_type' => 'required',
            'frame' => [

            ],
            'frame_options' => [

            ]
        ];
    }
}
