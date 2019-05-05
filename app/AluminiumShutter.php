<?php

namespace App;


use Illuminate\Validation\Rule;

class AluminiumShutter extends Shutter
{
    const NAME = 'Aluminium Shutter';

    public static function rules()
    {
        return parent::rules() + [
                'shutter_type' => [
                    'required',
                    Rule::in('Standard', 'Sliding', 'Bifold Track', 'U Channel')
                ],
                'corner' => [
                    'required',
                    Rule::in('No', '90', '135')
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
                    'required',
                    Rule::in('na', 'Centre', '1', '2')
                ],
                'mid_rail_height' => [

                ],
                'blade_size' => [
                    'required',
                     Rule::in('89mm')
                ],
                'tilt_rod' => [
                    'required',
                    Rule::in('Clear view')
                ],
                'colour' => [
                    'required',
                    Rule::in('White', 'Cream', 'Silver')
                ],
//                'stile_type' => [
//                    'required',
//                    Rule::in('50b')
//                ],
                'frame' => [
                    'required',
                    Rule::in('No Frame','L', 'U Channel', 'Bi Fold')
                ],

            ];
    }
}
