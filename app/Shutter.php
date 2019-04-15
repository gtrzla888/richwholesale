<?php

namespace App;


class Shutter extends Product
{
    const TYPE_BASSWOOD_SHUTTER = 'Bassword Shutter';
    const TYPE_PVC_SHUTTER = 'PVC Shutter';
    const TYPE_AU_PVC_SHUTTER = 'AU PVC Shutter';
    const TYPE_ALUMINIUM_SHUTTER = 'Aluminium Shutter';

    static $shutterTypes = [self::TYPE_BASSWOOD_SHUTTER, self::TYPE_AU_PVC_SHUTTER, self::TYPE_PVC_SHUTTER, self::TYPE_ALUMINIUM_SHUTTER];

    protected $guarded = [];

}
