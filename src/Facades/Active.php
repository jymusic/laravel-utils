<?php

namespace JYmusic\Utils\Facades;

use Illuminate\Support\Facades\Facade;
/**
 * Active facade class
 *
 * @author jymusic
 */
class Active extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'active';
    }
}
