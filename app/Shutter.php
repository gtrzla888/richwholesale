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

    public function getPrice()
    {
        $shutterPrice = new ShutterPrice([
            'product' => static::NAME,
            'width' => $this->width,
            'drop' => $this->drop,
            'shutter_type' => $this->shutter_type,
            'corner' => $this->corner,
            'frame' => $this->frame,
        ]);

        return $shutterPrice->getCost();
    }

}
