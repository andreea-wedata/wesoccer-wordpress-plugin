<?php

class Fixture
{
    public $id = null;
    public $events = [];
    
    public function __construct() {
        ;
    }
    
    public static function getAPIResult($address, $array = TRUE)
    {
        $client = new Client();
        $result = $client->get($address);
        $result = json_decode($result->getBody(), $array);
        
        return $result;
    }
}