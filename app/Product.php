<?php

namespace App;


use App\Order;
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
        if (isset($attributes['id'])) {
            $product = static::find($attributes['id']);
        }
        $product->fill($attributes);
        $product->save();

        return $product;
    }

    public static function rules()
    {
        return [
            'id' => 'integer',
            'name' => 'required|max:255',
            'width' => 'required|integer',
            'drop' => 'require|integer',
        ];
    }

    abstract function getPrice();

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
