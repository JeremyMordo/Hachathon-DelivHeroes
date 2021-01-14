<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\RequestType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class RequestController extends AbstractController
{

    /**
     * @Route("/HeroRequest", name="HeroRequest")
     */
    public function HeroRequest(Request $request, EntityManagerInterface $em)
    {
        $category = new Category();
        $form = $this->createForm(RequestType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('');
        }

        
        return $this->render('request.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}