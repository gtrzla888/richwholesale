<?php

namespace App;


use App\Service\ShutterPrice;

abstract class Shutter extends Product
{
    const NAME = 'Shutter';

    protected $table = 'shutters';

    protected $guarded = [];


    public static function create($attributes): Product
    {
        $attributes = $attributes + ['type' => static::NAME];

        return parent::create($attributes);
    }

    public static function rules()
    {
        return [
            'name' => 'required|max:255',
            'width' => 'required|integer',
            'drop' => 'required|integer',
        ];
    }

    public function getPrice()
    {
        $shutterPrice = new ShutterPrice([
            'product' => static::NAME,
            'width' => $this->width,
            'drop' => $this->drop,
            'colour' => $this->colour,
            'shutter_type' => $this->shutter_type,
            'corner' => $this->corner,
            'frame' => $this->frame,
        ]);

        return $shutterPrice->getCost();
    }

}
