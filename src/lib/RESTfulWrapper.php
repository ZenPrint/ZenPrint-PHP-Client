<?php

use RESTful\RESTful;

class RESTfulWrapper extends RESTful
{
    function __construct($url, $token) {
        parent::__construct($url, $token);
    }

    public function isSuccess() {
        return $this->getHeaderResponseCode() === "200";
    }
}
