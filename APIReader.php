<?php

use \GuzzleHttp\Client;

class APIReader
{
    
    static public function getResult($address, $array = TRUE)
    {
        $client = new Client();
        $result = $client->get($address);
        $result = json_decode($result->getBody(), $array);
        
        return $result;
    }
}