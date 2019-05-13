<?php

namespace App;


use App\Service\ShutterPrice;
use Illuminate\Validation\Rule;

abstract class Shutter extends Product
{
    const NAME = 'Shutter';

    protected $table = 'shutters';

    protected $guarded = [];

    public static function rules()
    {
        return [
            'id' => 'integer|nullable',
            'name' => 'required|max:255',
            'shutter_type' => [
                'required',
                Rule::in(  
                    'Standard',
                    'Sliding',
                    'Bifold Track',
                    'U Channel'
                )
            ],
            'corner' => [
                'required',
                Rule::in('No', '90', '135')
            ],
            'panel_layout' => [
                'required',
                'regex:/^[C|D|L|R|T|-]+$/i'
            ],
            'in_or_out' => [
                'required',
                Rule::in('In', 'Out')
            ],
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

    public function setPanelLayoutAttribute($value)
    {
        $this->attributes['panel_layout'] = strtoupper($value);
        preg_match_all('/[L|R]+/', $this->attributes['panel_layout'], $matches);
        $count = array_reduce(current($matches), function ($carry, $match) {
            $carry += strlen($match);

            return $carry;
        }, 0);

        $this->attributes['panel_qty'] = $count;
    }

}
