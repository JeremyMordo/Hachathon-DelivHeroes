<?php

namespace App\Controller;

use App\Service\SuperHeroApi;
use App\Form\SearchHeroesType;
use App\Repository\HeroesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/heroes", name="heroes_")
 */
class HeroesController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function HeroesList(): Response
    {
       
        return $this->render('heroeslist.html.twig', [
            //'heroes' => $heroes,
            //'form' => $form->createView(),
        ]);
    }
}