<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\Category;
use App\Entity\Hero;
use App\Form\TicketType;
use App\Service\Compare;
use App\Service\Average;
use App\Repository\HeroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use DateTime;

class TicketController extends AbstractController
{
    /**
     * @private $session
     * 
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("/ticket", name="ticket")
     */
    public function ticket(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $ticket = new Ticket();
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $resume = $data->getResume();
            $localisation = $data->getLocalisation();
            $category = $data->getCategory();

            $this->session->set('resume-loca', ['resume' => $resume, 'localisation' => $localisation]);

            return $this->redirectToRoute('ticket_result', ['id' => $category->getId()]);
        }

        return $this->render('ticket.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }

    /**
     * @Route("/ticket/submit/{id}", name="ticket_result")
     * @ParamConverter("Category", class="App\Entity\Category", options={"mapping":{"id" : "id"}})
    */
    public function ticketResult(Compare $compare, Average $average, Category $category, HeroRepository $heroRepository, AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
    
        $statRequired = $category->getStatRequired();

        $heroes = $heroRepository->findBy(
            ['alignment' => 'good']
        );

        foreach($heroes as $hero){
            $statHero = $hero->getPowerstats();
            $result = $compare->compare($statRequired, $statHero);

            if ($result === true){
                $allHeroes[] = $hero;
            }
        }
        foreach ($allHeroes as $hero) {
            $idHero = $hero->getId();
            $moyenneHero = $average->average($hero->getPowerstats());
            $goodHeroes[] = ['id' => $idHero, 'moyenne' => $moyenneHero];
        }

        $moyenne = array();
        
        foreach ($goodHeroes as $key => $row)
        {
            $moyenne[$key] = $row['moyenne'];
            
        }
        array_multisort($moyenne, SORT_DESC, $goodHeroes);

        foreach($goodHeroes as $key => $value){
            $hero = $heroRepository->findOneBy(
                ['id' => $value['id']]
            );
            $allGoodHeroes[]= $hero;
        }

        return $this->render('result.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
            'allgoodheroes' => $allGoodHeroes,
            'category' => $category
        ]);
    }

    /**
     * @Route("/ticket/{categoryId}/{heroId}", name="add_ticket", methods={"GET"})
     * @ParamConverter("hero", class="App\Entity\Hero", options={"mapping":{"heroId" : "id"}})
     * @ParamConverter("category", class="App\Entity\Category", options={"mapping":{"categoryId" : "id"}})
     */
    public function addTicket(Category $category, Hero $hero, AuthenticationUtils $authenticationUtils, EntityManagerInterface $em)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $data = $this->session->get('resume-loca');

        $resume = $data['resume'];
        $localisation = $data['localisation'];

        $ticket = new Ticket();
        $ticket->setCategory($category);
        $ticket->setResume($resume);
        $ticket->setLocalisation($localisation);
        $ticket->setStatus(1);
        $ticket->setHero($hero);
        $ticket->setInterventionSchedule(new DateTime('now'));
        $em->persist($ticket);
        $em->flush();

        return $this->render('success.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }
}