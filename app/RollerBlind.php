<?php

namespace App;


class RollerBlind extends Product
{
    protected $guarded = [];

    public static $rules = [
        'name' => 'required',
        
    ];
}
