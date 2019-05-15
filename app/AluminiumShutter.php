<?php

namespace App;


use Illuminate\Validation\Rule;

class AluminiumShutter extends Shutter
{
    const NAME = 'Aluminium Shutter';

    public static function rules()
    {
        return parent::rules() + [
                'width' => 'required|integer|min:250',
                'drop' => 'required|integer|max:3050|min:250',
                'mid_rail' => [
                    'required',
                    Rule::in('NA', 'Centre', '1', '2')
                ],
                'mid_rail_height' => [

                ],
                'blade_size' => [
                    'required',
                     Rule::in('89mm')
                ],
                'tilt_rod' => [
                    'required',
                    Rule::in('Clear View')
                ],
                'colour' => [
                    'required',
                    Rule::in('White', 'Cream', 'Silver')
                ],
                'frame' => [
                    'required',
                    Rule::in('No Frame','L', 'U Channel', 'Bi Fold')
                ],

            ];
    }
}
