<?php

namespace Aygon\DataListBundle\DataList\FilterForm\Model;

class Filters extends \ArrayObject
{
    public function get($key, $default = null)
    {
        return $this->offsetExists($key) ? $this->offsetGet($key) : $default;
    }
    
    public function has($key)
    {
        return $this->offsetExists($key) && $this->offsetGet($key);
    }
}