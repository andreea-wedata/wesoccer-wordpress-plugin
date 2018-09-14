<?php

//require_once 'wesoccer_functions.php';

use \GuzzleHttp\Client;

class Competition
{
    public $id = null;
    public $fixtures = [];
    public $competition_info = [];
    
    public function __construct($id) {
        $this->id = $id;
        $data = self::getAPIResult("http://wesoccer.test/api/v1/competition/{$this->id}/fixtures");
        $grouped_fixtures = [];
        foreach ($data[$this->id]['fixtures'] as $element) {
            $grouped_fixtures[$element['group_by']][] = $element;
        }
        $this->fixtures = array_reverse($grouped_fixtures);
        $this->competition_info = $data[$this->id]['competition'];
    }
    
    public static function getCompetitionIds()
    {
        return [
            '59',
            '60'
        ];
    }
    
    public function getFixtureHtml()
    {
        
    }
    
    public function displayFixtures()
    {
        $html = "<ul>";
        foreach ($this->fixtures AS $fixture)
        $html .= "</ul>";
    }
    
    public static function getAPIResult($address, $array = TRUE)
    {
        $client = new Client();
        $result = $client->get($address);
        $result = json_decode($result->getBody(), $array);
        
        return $result;
    }
}