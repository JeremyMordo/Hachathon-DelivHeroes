<?php

namespace App\Controller;

use App\Service\SuperHeroApi;
use App\Repository\HeroesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(HeroesRepository $heroesRepository): Response
    {
        $heroes = $heroesRepository->findAll();

        return $this->render('index.html.twig', ['heroes' => $heroes]);
    }
}