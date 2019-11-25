<?php

namespace JYmusic\Utils\Facade;

use Illuminate\Support\Facades\Facade;

class Utils extends Facade
{
    /**
     * The name of the binding in the IoC container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \JYmusic\Utils\Util::class;
    }
}
