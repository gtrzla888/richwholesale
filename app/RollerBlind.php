<?php

namespace App;


class RollerBlind extends Product
{
    const NAME = 'Roller Blind';

    protected $guarded = [];

    public static $rules = [
        'name' => 'required',

    ];
}
