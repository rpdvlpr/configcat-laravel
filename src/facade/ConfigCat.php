<?php

namespace Rp\Config\Facade;

class ConfigCat extends \Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'configcat';
    }
}
