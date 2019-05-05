<?php

namespace App;


use Illuminate\Validation\Rule;

class BasswoodShutter extends Shutter
{
    const NAME = 'Basswood Shutter';

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
                Rule::in('In', 'Out')
            ],
            'mid_rail' => [
                'required'
            ],
            'mid_rail_height' => [

            ],
            'blade_size' => [
                'required',
                Rule::in(
                    '47mm',
                    '89mm',
                    '64mm',
                    '114mm'
                )
            ],
            'tilt_rod' => [
                'required',
                Rule::in(
                    'Clear View',
                    'Central'
                )
            ],
            'colour' => [
                'required',
                Rule::in(
                    'W100 Snow',
                    'W101 Dove',
                    'W104 China',
                    'W105 Soft Pearl',
                    'W107 Pearl',
                    'W109 Linen Wash',
                    'W115 Clay',
                    'W118 Wheat',
                    'W401 Eggshell',
                    'W402 Palm Beach',
                    'W00 Custom',
                    'S430 Black Ash',
                    'S508 Jet',
                    'S602 Maple',
                    'S604 Aged Teak',
                    'S606 Mahogan',
                    'S701 Walnut',
                )
            ],
            'stile_type' => [
                'required',
                Rule::in(
                    '50b',
                    '60b',
                    '50f',
                    '60f'
                )
            ],
            'frame' => [
                'required',
                Rule::in(
                    'No Frame',
                    'FL50-B9',
                    'BL50-B10',
                    'BC65-B14A',
                    'BC50-B14',
                    'Z35-C7',
                    'Z20-C6',
                    'CZ25-D1',
                    'CZ25-D2',
                    'BL65-B10A'
                )
            ],
            'frame_options' => [
                'required',
                Rule::in('na','LRTB', 'LRT', 'LRB')
            ],
            'hinge_type' => [
                'required',
                Rule::in('na', 'Non Mortised', 'Pivot', 'Hang strip')
            ],
            'hinge_colour' => [
                'required',
                Rule::in(
                    'White',
                    'Bright Brass',
                    'Nickel',
                    'Black',
                    'Stainless',
                    'Colour Match'
                )
            ]
        ];
    }
}
