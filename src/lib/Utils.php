<?php

use Assert\Assertion;

class Utils
{
    /**
     * Determines and return a value is in a hash if it exists, if not returns null
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

    /**
     * Adds a key/value pair to an associative array if the value exists
     *
     * @param mixed $array
     * @param string $key
     * @param mixed $value
     * @return void
     * @throws \Assert\AssertionFailedException
     */
    public function opt(&$array, $key, $value) 
    {
        Assertion::isArray($array);
        Assertion::string($key);
        if ($value) {
            $array[$key] = $value;
        }
    }
}
