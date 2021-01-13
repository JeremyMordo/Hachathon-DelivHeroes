<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class SuperHeroApi
{
    // used to retrieve API data 
    public function selectHero($number)
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

    //Used to save API data in DB in a controller
    /**
     * @Route("/", name="home")
     */
    // public function allHeroes(EntityManagerInterface $em)
    // {
    //     $APIHero = new SuperHeroApi();
        
    //     for($i=700;$i<=731;$i++)
    //     { 
    //         $hero = new Hero;
    //         $heroes = $APIHero->selectHero($i);
    //         $hero->setName($heroes['name']);
    //         $hero->setPowerstats($heroes['powerstats']);
    //         $hero->setAlignment($heroes['biography']['alignment']);
    //         $hero->setImage($heroes['image']['url']);
    //         $hero->setBase($heroes['work']['base']);
    //         $hero->setGroupAffiliation($heroes['connections']['group-affiliation']);

    //         $em->persist($hero);
    //     }
        
    //     $em->flush();


    //     return $this->render('index.html.twig');
    // }
}