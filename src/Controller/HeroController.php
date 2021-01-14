<?php

namespace App\Controller;

use App\Service\SuperHeroApi;
use App\Form\SearchHeroType;
use App\Repository\HeroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/heroes", name="heroes_")
 */
class HeroController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function HeroesList(Request $request, HeroRepository $heroRepository): Response
    {
        $form = $this->createForm(SearchHeroType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $heroes = $heroRepository->findLikeName($search);
        } else {
            $heroes = $heroRepository->findAll();
        }
        if (!$heroes) {
            $this->addFlash('danger', 'Pas d\'entreprises portant ce nom');
        }

        return $this->render('heroes.html.twig', [
            'heroes' => $heroes,
            'form' => $form->createView(),
        ]);
    }
}