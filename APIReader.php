<?php

use \GuzzleHttp\Client;

class APIReader
{
    
    static public function getResult($address, $array = TRUE)
    {
        $token = self::requestNewToken();
        $client = new Client();
        
        $response = $client->request('GET', $address, [
            'headers' => [
                'Authorization'     => 'Bearer '.$token
                ]
            ]);
        $response = json_decode($response->getBody(), $array);
        
        return $response;
    }
    
    static public function requestNewToken()
    {
        $client = new Client();
        $token_response = $client->post("https://develop.wesoccer.co.uk/api/login", [
		'headers' => [
			'content-type' => 'application/x-www-form-urlencoded',
			
		],
		'form_params' => [
			'email' => get_option('wesoccer_email')['wesoccer_field_wesoccer_email'],
			'password' => get_option('wesoccer_password')['wesoccer_field_wesoccer_password'],
                ]
        ]);
        $token = json_decode($token_response->getBody(), TRUE)['token'];
    }
}