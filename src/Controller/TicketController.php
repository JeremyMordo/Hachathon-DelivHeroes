<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\Category;
use App\Form\TicketType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TicketController extends AbstractController
{

    /**
     * @Route("/ticket", name="ticket")
     */
    public function ticket(Request $request, EntityManagerInterface $em)
    {
        $ticket = new Ticket();
        $form = $this->createForm(TicketType::class, $ticket);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ticket);
            $entityManager->flush();

            return $this->redirectToRoute('');
        }

        
        return $this->render('ticket.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}