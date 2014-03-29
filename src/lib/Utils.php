<?php

use Assert\Assertion;

class Utils
{
    /**
     * Determine if a value is in a hash, if not return null
     *
     * @param string $value
     * @param mixed $array
     * @return string|null
     * @throws \Assert\AssertionFailedException
     */
    public function set($key, $array) 
    {
        Assertion::string($key);
        Assertion::isArray($array);
        return (ISSET($array[$key]) ? $array[$key] : null);
    }
}
