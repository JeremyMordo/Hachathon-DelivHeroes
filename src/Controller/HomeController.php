<?php

namespace App\Controller;

use App\Service\SuperHeroApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function allHeroes()
    {
        $allHeroes = new SuperHeroApi();
        for($i=0;$i<10;$i++) 
        {
            $number=rand(0, 731);
            $numberAlreadyPassed[]= $number;
            if(!in_array($number, $numberAlreadyPassed)) {
                $heroes[]= $allHeroes->selectTwentyHeroes($number);
            } else {
                $i--;
            }
        }

        return $this->render('index.html.twig', ['heroes' => $heroes]);
    }
}