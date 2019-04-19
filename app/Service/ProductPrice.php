<?php


namespace App\Service;


class ProductPrice
{
    const MIN_AREA = 0.5;

    private $config;

    private $pricePerSqm = 0;

    private $fixedPrice = 0;

    private $criteria = [];

    public function __construct($criteria)
    {
        $config = app('config')->get('price');
        $this->criteria = $criteria;
        $this->config = $config[$criteria['product']];
    }

    private function area()
    {
        return $this->criteria['width'] / 1000 * $this->criteria['drop'] / 1000;
    }

    public function getCost()
    {
        $this->getPrice('shutter_type');
        $this->getPrice('frame');
        $this->getPrice('corner');
        $this->getPrice('color');

        return $this->area() * $this->pricePerSqm + $this->fixedPrice;
    }

    protected function getPrice($field)
    {
        $price = $this->config[$field][$this->criteria[$field]];

        if ($price['unit'] == 'sqm') {
            $this->pricePerSqm = $price['price'] + $this->pricePerSqm;
        } else {
            $this->fixedPrice = $price['price'] + $this->fixedPrice;
        }
    }
}