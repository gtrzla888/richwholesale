<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class PVCShutter extends Shutter
{
    const NAME = 'PVC Shutter';

    public static function rules()
    {
        return parent::rules() + [
                'width' => 'required|integer|min:300',
                'drop' => 'required|integer|min:300',
                'mid_rail' => [
                    'required',
                    Rule::in('na', 'Centre', '1', '2')
                ],
                'mid_rail_height' => [

                ],
                'blade_size' => [
                    'required',
                    Rule::in('89mm', '64mm')
                ],
                'tilt_rod' => [
                    'required',
                    Rule::in('Clear View', 'Central')
                ],
                'colour' => [
                    'required',
                    Rule::in('W100 Snow', 'W101 Dove', 'W104 China', 'W105 Soft Pearl', 'W107 Pearl', 'W109 Linen Wash', 'W115 Clay', 'W118 Wheat', 'W401 Eggshell', 'W402 Palm Beach', 'W00 Custom')
                ],
                'stile_type' => [
                    'required',
                    Rule::in('50b')
                ],
                'frame' => [
                    'required',
                    Rule::in('No Frame','Z20-C6', 'BL50-B10', 'BL65-B10A')
                ],
                'frame_options' => [
                    'required',
                    Rule::in('na','LRTB', 'LRT', 'LRB')
                ],
                'hinge_type' => [
                    'required',
                    Rule::in('na', 'Non Mortised', 'Pivot')
                ],
                'hinge_colour' => [
                    'required',
                    Rule::in('White', 'Nickel', 'Stainless', 'Colour Match')
                ]
            ];
    }

}
