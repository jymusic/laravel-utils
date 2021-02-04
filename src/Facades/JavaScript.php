<?php

namespace JYmusic\Utils\Facades;

use Illuminate\Support\Facades\Facade;
/**
 * JavaScript facade class
 *
 * @author jymusic
 */
class JavaScript extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'javaScript';
    }
}
