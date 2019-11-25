<?php

namespace JYmusic\Utils;

use Illuminate\Support\Facades\Facade;

class UtilsFacade extends Facade
{
    /**
     * The name of the binding in the IoC container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'utils';
    }
}
