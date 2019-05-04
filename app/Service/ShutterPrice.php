<?php


namespace App\Service;


class ShutterPrice
{
    const MIN_AREA = 0.5;

    private $config;

    private $pricePerSqm = 0;

    private $addonPrice = 0;

    private $criteria = [];

    public function __construct($criteria)
    {
        $config = app('config')->get('shutter');
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
        $this->getPrice('colour');

        return $this->area() * $this->pricePerSqm + $this->addonPrice;
    }

    protected function getPrice($field)
    {
        $price = $this->config[$field][$this->criteria[$field]];

        if ($price['unit'] == 'sqm') {
            $this->pricePerSqm = $price['price'] + $this->pricePerSqm;
        } else {
            $this->addonPrice = $price['price'] + $this->addonPrice;
        }
    }
}
