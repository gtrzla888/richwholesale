<?php

namespace App;


use App\Service\RollerBlindPrice;
use Illuminate\Validation\Rule;


class RollerBlind extends Product
{
    const NAME = 'Roller Blind';

    protected $guarded = [];

    public static function rules()
    {
        return parent::rules() + [
            'width' => 'required|integer|max:3010',
            'drop' => 'required|integer|max:3300',
            'type' => [
                'required',
                 Rule::in(['Blockout', 'Screen', 'Light Filter'])
            ],
            'fabric' => [
                'required'
            ],
            'colour' => [
                'required'
            ],
            'control_type' => [
                'required',
                Rule::in(
                    'Chain', 'Motor'
                )
            ],
            'control_side' => [
                'required',
                Rule::in(
                    'Left', 'Right'
                )
            ],
            'chain_length' => [
                'required',
            ],
            'component_colour' => [
                'required',
                Rule::in(
                    'White',
                    'Black'
                )
            ],
            'base_rail' => [
                'required',
                Rule::in(
                    'Silver',
                    'Black'
                )
            ],
            'roll_direction' => [
                'required',
                Rule::in(
                    'Standard',
                    'Reverse'
                )
            ],
            'motor_type' => [
                'required',
                Rule::in(
                    'NA',
                    'Acmeda 240v',
                    'Acmeda Li Ion 1.1nm',
                    'Acmeda Li Ion 3.0nm'
                )
            ],
            'charger' => [
                'required',
                Rule::in(
                    'NA',
                    'Yes'
                )
            ],
            'wifi_hub' => [
                'required',
                Rule::in(
                    'NA',
                    'Acmeda Pulse'
                )
            ],
            'remote' => [
                'required',
                Rule::in(
                    'NA',
                    '1 Channel',
                    '15 Channel'
                )
            ],
            'bracket_options' => [
                'required',
                Rule::in(
                    'Single',
                    'Slim Combo Top Front',
                    'Slim Combo Top Back',
                    'Double Bracket'
                )
            ],
            'notes' => [

            ]
        ];
    }

    public function getPrice()
    {
        $shutterPrice = new RollerBlindPrice([
            'product' => static::NAME,
            'width' => $this->width,
            'drop' => $this->drop,
            'type' => $this->type,
            'fabric' => $this->fabric,
            'motor_type' => $this->motor_type,
            'charger' => $this->charger,
            'wifi_hub' => $this->wifi_hub,
            'remote' => $this->remote,
            'bracket_options' => $this->bracket_options,
        ]);

        return $shutterPrice->getCost();
    }
}
