<?php

namespace App;


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
}
