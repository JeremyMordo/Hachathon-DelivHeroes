<?php

namespace App\Controller;

use App\Service\SuperHeroApi;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hero;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $allHeroes = $this->getDoctrine()
            ->getRepository(Hero::class)
            ->findAll();

        // Random twelwe images    
        $random_keys=array_rand($allHeroes,12);

        for($i=0;$i<=11;$i++)
        {
        $heroes []= $allHeroes[$random_keys[$i]];
        }
        
        return $this->render('index.html.twig', [
            'heroes'=> $heroes
        ]);

    }
}