<?php
namespace App;


use Illuminate\Validation\Rule;

class AUPVCShutter extends Shutter
{
    const NAME = 'AU PVC Shutter';

    public static function rules()
    {
        return parent::rules() + [
                'width' => 'required|integer|min:250',
                'drop' => 'required|integer|max:2440|min:250',
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
                    Rule::in('Clear View')
                ],
                'colour' => [
                    'required',
                     Rule::in(
                         'White',
                         'Off White',
                         'Custom'
                     )
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
                    Rule::in(  'White')
                ]
            ];
    }


}
