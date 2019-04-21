<?php


namespace App\Service;


class RollerBlindPrice
{

    private $config;

    private $criteria = [];

    public function __construct($criteria)
    {
        $this->config = app('config')->get('roller_blind');
        $this->criteria = $criteria;
    }

    public function getCost()
    {
        return $this->getBasePrice() + $this->getAddon();
    }

    private function priceGroup()
    {
        $fabricType = sprintf('%s - %s', $this->criteria['type'], $this->criteria['fabric']);

        return $this->config['groups'][$fabricType];
    }

    private function getBasePrice()
    {
        $group = $this->config['base'][$this->priceGroup()];

        foreach ($group as $price => $condition)
        {
            if (reset($condition['width']) < $this->criteria['width']
                && $this->criteria['width'] <= end($condition['width'])
                && reset($condition['drop']) < $this->criteria['drop']
                && $this->criteria['drop'] <= end($condition['drop']))  {
                return $price;
            }
        }

        return null;
    }

    private function getAddon()
    {
        $addon = $this->config['addon'];

        $motorType = $addon['motor_type'][$this->criteria['motor_type']];
        $charger = $addon['charger'][$this->criteria['charger']];
        $wifiHub = $addon['wifi_hub'][$this->criteria['wifi_hub']];
        $remote = $addon['remote'][$this->criteria['remote']];
        $bracketOptions = $addon['bracket_options'][$this->criteria['bracket_options']];

        return $motorType + $charger + $wifiHub + $remote + $bracketOptions;
    }
}