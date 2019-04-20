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
            'type' => [
                'required',
                Rule::in(['Blockout', 'Screen', 'Light Filter'])
            ],

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
