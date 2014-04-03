<?php

namespace RESTful 
{
    class RESTful 
    {
        private $returnValue = null;

        function __construct($a, $b) {  } 

        function get($resource) 
        {
            switch ($resource) {
                case "customers":
                    $this->returnValue = '{
                        "5": {
                            "email": "nate@zenprint.com",
                            "firstname": "Nate",
                            "lastname": "Jensen",
                            "password": "1234567"
                        }
                    }';
                    break;
                case "customers/23":
                    $this->returnValue = '{
                            "email": "dave@zenprint.com",
                            "firstname": "Dave",
                            "middlename": "Da Man",
                            "lastname": "Boyce",
                            "password": "ab34d5e",
                            "prefix": "Mr.",
                            "suffix": "Sr",
                            "taxvat": "GB999 9999 73"
                        }';
                    break;
                case "customers/22/balance":
                    $this->returnValue = '{
                            "credit_total": "101.56"
                        }';
                    break;
            }

            return $this->returnValue;
        }

        function put($resource, $data) 
        {
            return Array (
                'resource' => $resource,
                'data' => $data
            );
        }

        function post($resource, $data) 
        {

            //If the customer was created successfully, we receive Response HTTP Code = 200, empty Response Body and Location header like '/api/rest/v1.0/customers/555' where '555' - an entity id of the new customer. 
            return Array(
                'resource' => $resource,
                'data' => $data
            );
        }

        function delete($resource) 
        {
            return Array(
                'resource' => $resource
            );
        }

        function getHeaderResponseCode()
        {
            return $GLOBALS['headerResponseCode'];
        }

        function getResponseBody()
        {
            return $GLOBALS['responseBody'];
        }

        function getHeaderLocation()
        {
            return $GLOBALS['headerLocation'];
        }
    }
}
