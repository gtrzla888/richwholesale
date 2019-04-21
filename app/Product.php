<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

abstract class Product extends Model
{
    const NAME = 'Product';

    public static $rules = [];

    /**
     * @param $attributes
     *
     * @return Product
     */
    public static function create($attributes): Product
    {
        $product = new static();
        $product->fill($attributes);
        $product->save();

        return $product;
    }

    public static function rules()
    {
        return [
            'name' => 'required|max:255',
            'width' => 'required|integer',
            'drop' => 'require|integer',
        ];
    }

    abstract function getPrice();
}
