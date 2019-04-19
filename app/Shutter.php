<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

abstract class Shutter extends Product
{
    const NAME = 'Shutter';

    protected $table = 'shutters';

    protected $guarded = [];


    public static function create($attributes): Model
    {
        $attributes = $attributes + ['name' => static::NAME];

        return parent::create($attributes);
    }

    public static function rules()
    {
        return [
            'name' => 'required|max:255',
            'width' => 'required|integer',
            'drop' => 'require|integer',
        ];
    }

}
