<?php

namespace JYmusic\Utils\JavaScript;

class DefaultTransformer
{
    public function transform($value)
    {
        return json_encode($value);
    }
}
