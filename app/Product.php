<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

abstract class Product extends Model
{
    const NAME = 'Product';

    public static $rules = [];

    public static function create($attributes): Model
    {
        $shutter = new static();
        $shutter->fill($attributes);
        $shutter->save();

        return $shutter;
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
