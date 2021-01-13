<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class SuperHeroApi
{
    public function selectTwentyHeroes($number)
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://superheroapi.com/api/10224708539681999/' . $number
        );
        
        $statusCode = $response->getStatusCode(); // get Response status code 200

        if ($statusCode === 200) {
            $content = $response->getContent();
            // get the response in JSON format

            $content = $response->toArray();
            // convert the response (here in JSON) to an PHP array
            
            return $content;
        }
    }
}